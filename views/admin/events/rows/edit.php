<?php include_once dirname(__FILE__) . "/../../../layouts/header.php" ?>
<?php include_once dirname(__FILE__) . "/../../layouts/admin-before.php" ?>

<section class="event__rows__edit">
    <div class="container">

        <div class="event__rows__edit__rows__wrapper">
            <?php /** @var array $rows */
            foreach($rows as $row){ ?>
                <div class="event__rows__edit__row">
                    <div class="event__rows__edit__row__title">Ряд №<?=$row->num ?></div>
                    <a href="/" class="event__rows__edit__row__edit-btn">Места</a>
                    <a href="/" class="event__rows__edit__row__delete-btn">Удалить</a>
                </div>
            <?php }?>

            <a class="event__rows__edit__row__create-btn" href="/">Добавить ряд</a>
        </div>


    </div>
</section>

<?php
include_once dirname(__FILE__) . "/../../../layouts/footer.php" ?>