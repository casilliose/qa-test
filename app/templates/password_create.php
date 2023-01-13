<link href="/main.css" rel="stylesheet">
<form action="" method="post" class="form-reg" name="pass">
    <p class="title">Создайте пароль <a href="/">Авторизация</a></p>
    <input type="text" required placeholder="Введите пароль" value="" name="pass1" /><br/><br/>
    <input type="text" required placeholder="Введите подтверждение пароля" value="" name="pass2" /><br/><br/>
    <?php
    if (!empty($message)) {
        echo $message;
    }
    ?>
    <button type="submit" name="pass" value="Сохранить">Сохранить</button>
</form>

