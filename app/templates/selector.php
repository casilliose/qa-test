<link href="/main.css" rel="stylesheet">
<section>
    <script>
      function logout(event)
      {
        if(confirm("Вы действительно хотите выйти ?")) {
        } else {
          event.stopImmediatePropagation();
          event.preventDefault();
          var xhr = new XMLHttpRequest();
          xhr.open('GET', '/del-all-users/', false);
          xhr.send();
          window.location.href = "http://localhost:9100";
          return false;
        }
      }
      function addToOffer(id)
      {
        if(confirm("Подать заявку на кредит ?")) {
          var xhr = new XMLHttpRequest();
          xhr.open('GET', '/add-offer/'+id+"/", false);
          xhr.send();
          alert("Ваша заявка принята");
        }
      }
    </script>
    <a href="/selector/">Заявка на кредит</a>
    <a href="/credit-history/">История заявок</a>
    <a href="/logout/" onclick="logout(event);">Выход</a>
</section>
<?php if (!empty($select)):?>
    <?php
        if (!empty($result)) {
            echo "<p>Итоги поиска:</p>";
            foreach ($result as $key => $item) {
                ?>
                <div class="item">
                    <p><b><?php echo $item['name'];?></b></p>
                    <p>Сумма кредита : от <?php echo $item['min_amount'];?> до <?php echo $item['max_amount'];?></p>
                    <p>Срок кредита : от <?php echo $item['min_term'];?> до <?php echo $item['max_term'];?></p>
                    <p>Цель кредита : <?php
                        if ($item['target'] == 1) {
                            echo "потребительский";
                        } else if ($item['target'] == 2) {
                            echo "авто";
                        } else {
                            echo "ипотека";
                        }
                        ?></p>
                    <p>Кредитная история : <?php
                        if ($item['history'] == 1) {
                            echo "нет просрочки";
                        } else if ($item['history'] == 2) {
                            echo "были просрочки";
                        } else if ($item['history'] == 3){
                            echo "есть просрочки";
                        } else {
                            echo "готов оформить банкротство";
                        }
                        ?></p>
                    <p>Наличие недвижимости : <?php
                        if ($item['real_estate'] == 1) {
                            echo "есть частная";
                        } else if ($item['real_estate'] == 2) {
                            echo "есть коммерческая";
                        } else {
                            echo "нет";
                        }
                        ?></p>
                    <p>Наличие недвижимости : <?php
                        if ($item['have_car'] == 1) {
                            echo "есть";
                        } else {
                            echo "нет";
                        }
                        ?></p>
                    <button onclick="addToOffer(<?php echo $item['id'];?>);">Подать заявку</button>
                </div>
                <?php
            }
        } else {
            echo "Поиск не дал результатов, подберите другой <a href='http://localhost:9100/selector/'>Подобрать</a>";
        }
    ?>
<?php else:?>
<form action="/selector-result/" method="post" class="form-reg">
    <p class="title">Подбор кредита</p>
    <input type="number" required placeholder="Сумма кредита" value="" name="amount" /><br/><br/>
    <input type="number" required placeholder="Срок кредита" value="" name="term" /><br/><br/>
    <label>Цель кредита:
    <select required name="target">
        <option value="1">потребительский</option>
        <option value="2">авто</option>
        <option value="3">ипотека</option>
    </select><br/><br/></label>
    <div>Кредитная история: <br/>
        <label><input type="radio" name="history" value="1" />нет просрочки</label><br/>
        <label><input type="radio" name="history" value="2" />были просрочки</label><br/>
        <label><input type="radio" name="history" value="3" />есть просрочки</label><br/>
        <label><input type="radio" name="history" value="4" />готов оформить банкротство</label>
        <br/></div> <br/>
    <div>Наличие недвижимости: <br/>
        <label><input type="radio" name="real_estate" value="1" />есть частная</label><br/>
        <label><input type="radio" name="real_estate" value="2" />есть коммерческая</label><br/>
        <label><input type="radio" name="real_estate" value="3" />нет</label><br/>
        <br/></div>
    <div>Наличие автомобиля: <br/>
        <label><input type="radio" name="have_car" value="1" />есть</label><br/>
        <label><input type="radio" name="have_car" value="2" />нет</label><br/>
        <br/></div>
    <?php
    if (!empty($message)) {
        echo $message;
    }
    ?>
    <button type="submit" name="selector" value="Подобрать">Подобрать</button>
</form>
<?php endif;?>