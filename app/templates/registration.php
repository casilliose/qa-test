<link href="/main.css" rel="stylesheet">
<form action="" method="post" class="form-reg" name="reg">
    <p class="title">Регистрация <a href="/">Авторизация</a></p>
    <input type="text" required placeholder="Введите имя" value="" name="name" /><br/><br/>
    <input type="text" required placeholder="Введите фамилия" value="" name="lastname" /><br/><br/>
    <input type="email" required placeholder="Введите email" value="" name="email" /><br/><br/>
    <label>День рождения: <select required name="birthday-day">
            <?php
            for ($i = 1; $i <= 31; $i++) {
                echo "<option value='$i'>$i</option>";
            }
            ?>
    </select>
    <select required name="birthday-month">
        <option value="1">Январь</option>
        <option value="2">Февраль</option>
        <option value="3">Март</option>
        <option value="4">Апрель</option>
        <option value="5">Май</option>
        <option value="6">Июнь</option>
        <option value="7">Июль</option>
        <option value="8">Август</option>
        <option value="9">Сентябрь</option>
        <option value="10">Октябрь</option>
        <option value="11">Ноябрь</option>
        <option value="12">Декабрь</option>
    </select>
        <select required required name="birthday-year">
            <?php
                for ($i = 1970; $i < 2023; $i++) {
                    echo "<option value='$i'>$i</option>";
                }
            ?>
        </select>
    </label><br/><br/>
    <?php
    if (!empty($message)) {
        echo $message;
    }
    ?>
    <button type="submit" name="reg" value="Создать">Создать</button>
</form>
