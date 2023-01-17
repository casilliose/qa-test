<link href="/main.css" rel="stylesheet">
<form action="/<?php echo !empty($access) ? "?token=".$access : "";?>" method="post" class="form-reg" name="auth">
    <p class="title">Авторизация <a href="/registration/<?php echo !empty($access) ? "?token=".$access : "";?>">Регистрация</a></p>
    <input type="email" required placeholder="Введите логин" value="" name="login" /><br/><br/>
    <input type="password" required placeholder="Введите пароль" value="" name="password" /><br/><br/>
    <?php
        if (!empty($message)) {
            echo $message;
        }
    ?>
    <button type="submit" name="auth" value="Войти">Войти</button>
</form>