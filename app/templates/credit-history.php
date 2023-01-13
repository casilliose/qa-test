<link href="/main.css" rel="stylesheet">
<section>
    <a href="/selector/">Заявка на кредит</a>
    <a href="/credit-history/">История заявок</a>
</section>
<?php if (!empty($result)):?>
    <?php
    echo "<p>Кредитная история:</p>";
    foreach ($result as $key => $item) {
        ?>
        <div class="item">
            <p><b><?php echo $item['name'];?></b></p>
            <p>Дата подачи заявки: <?php echo $item['create_date'];?></p>
            <p>Информация о кредите:</p>
            <div class="history-block">
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
            </div>
        </div>
        <?php
    }
    ?>
<?php else:?>
    <p>У вас нет кредитной истории !!!</p>
<?php endif;?>