<?php

declare(strict_types=1);

namespace App;

require __DIR__ . '/vendor/autoload.php';

use Exception;
use Phroute\Phroute\RouteCollector;
use Phroute\Phroute\Dispatcher;
use Symfony\Component\HttpFoundation\Request;
use Phroute\Phroute\Exception\HttpRouteNotFoundException;
use Symfony\Component\HttpFoundation\Session\Session;

try {
    $config = require __DIR__ . '/config.php';
    $access = "";
    $host = "localhost:9100";
    if ($config['prod'] == true) {
        $subDomain = explode('.', $_SERVER['HTTP_HOST']);
        $configSandBox = require __DIR__ . '/config_sandbox.php';
        if (count($subDomain)) {
            $check = $subDomain[0];
            if (isset($configSandBox[$check])) {
                $config['db'] = $configSandBox[$check]['db'];
            }
            if (
                empty($_GET['token']) ||
                $_GET['token'] !== $configSandBox[$check]['access']
            ) {
                echo "You need access";
                die();
            }
        } else if($_GET['token'] !== $configSandBox["root_access"]) {
            echo "You can use also subdomain";
            die();
        }
        $_SERVER['REQUEST_URI'] = str_replace('?token='.$configSandBox[$check]['access'], '', $_SERVER['REQUEST_URI']);
        $access = $configSandBox[$check]['access'];
        $host = $configSandBox[$check]['domain'];
    }

    $request = Request::createFromGlobals();
    $router = new RouteCollector();
    $session = new Session();
    $ac = !empty($access) ? "?token=".$access : "";
    $router->any('/', function () use ($request, $config, $session, $access, $ac) {
        $message = "";
        if (!empty($request->get("auth"))) {
            $auth = new Auth($config);
            if ($auth->isUserCreated($request->get("login"))) {
                $session->start();
                $session->set("user", $auth->getUserByLogin($request->get("login")));
                header("Location: /selector/".$ac);
                exit(0);
            } else {
                $message = "<p class='error-double'>Пользователь с таким email не зарегестрирован</p>";
            }
        }
        return include "./templates/auth.php";
    });

    $router->any('/registration/', function () use ($request, $config, $access, $host) {
        $message = "";
        if (!empty($request->get("reg"))) {
            $reg = new Registration($config);
            if ($reg->checkDoubleUser($request->get("email"))) {
                $message = "<p class='error-double'>Пользователь с таким email уже существует</p>";
            } else {
                if ($reg->createUser($request)) {
                    $ac = !empty($access) ? "?token=".$access : "";
                    if($reg->sendApproveEmail($request->get("email"), $ac, $host)){
                        return "<p style='color: green;'>Пользователь успешно создан, на почту придет ссылка на подтверждение</p> <a href='/$ac'>авторизоваться</a>";
                    } else {
                        $message = "<p class='error-double'>Email на подтверждение не смог быть отправлен</p>";
                    }
                } else {
                    $message = "<p class='error-double'>Упс, ошибка сервера попробуйте позже</p>";
                }
            }
        }
        return include "./templates/registration.php";
    });

    $router->any('/password-create/{pass}/{email}', function ($pass, $email) use ($request, $config, $access, $ac) {
        if (!$pass || !$email) {
            header("Location: /".$ac);
            exit(0);
        }
        $message = "";
        $email = base64_decode($email);
        $reg = new Registration($config);
        if ($reg->checkUserIsNotPassword($email, $pass)) {
            if ($request->get("pass")) {
                if ($request->get("pass1") !== $request->get("pass2")) {
                    $message = "<p class='error-double'>Пароли не совпадают</p>";
                } else {
                    if($reg->savePassword($request->get("pass1"),$email, $pass)) {
                        header("Location: /".$ac);
                        exit(0);
                    } else {
                        $message = "<p class='error-double'>Упс, ошибка сервера попробуйте позже</p>";
                    }
                }
            }
            return include "templates/password_create.php";
        } else {
            header("Location: /".$ac);
            exit(0);
        }
        return "";
    });

    $router->any('/selector/', function () use ($request, $config, $session, $access, $ac) {
        if (!$session->get("user")) {
            header("Location: /".$ac);
            exit(0);
        }
        return include "templates/selector.php";
    });

    $router->any('/del-all-users/', function () use ($config, $session, $access) {
        (new User($config))->removeAllUsers();
        $session->remove("user");
        $session->clear();
        return "success";
    });

    $router->any('/logout/', function () use ($session, $access, $ac) {
        $session->remove("user");
        $session->clear();
        header("Location: /".$ac);
        exit(0);
    });

    $router->any('/selector-result/', function () use ($config, $request, $session, $access, $ac) {
        if (!$session->get("user")) {
            header("Location: /".$ac);
            exit(0);
        }
        $select = "";
        $result = [];
        if ($request->get('selector')) {
            $selector = new Selector($config);
            $result = $selector->getResultByFilter($request);
            $select = "true";
        }
        return include "templates/selector.php";
    });

    $router->any('/add-offer/{id}', function ($id) use ($config, $session, $access, $ac) {
        if (!$session->get("user")) {
            header("Location: /".$ac);
            exit(0);
        }
        return (new Offer($config))->addOffer($id, $session->get('user')['id']);
    });

    $router->any('/credit-history/', function () use ($config, $session, $access, $ac){
        if (!$session->get("user")) {
            header("Location: /".$ac);
            exit(0);
        }
        $result = (new HistoryCredits($config))->getHistoryByUser($session->get('user')['id']);
        return include "templates/credit-history.php";
    });

    $dispatcher = new Dispatcher($router->getData());
    echo $dispatcher->dispatch($request->getMethod(), $request->getRequestUri());
} catch (HttpRouteNotFoundException $e) {
    echo $e->getMessage();
    http_response_code(404);
    include('404.php');
    die();
} catch (Exception $e) {
    echo $e->getMessage();
    include('500.php');
    die();
}