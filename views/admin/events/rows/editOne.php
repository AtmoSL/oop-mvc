<?php include_once dirname(__FILE__) . "/../../../layouts/header.php" ?>
<?php include_once dirname(__FILE__) . "/../../layouts/admin-before.php" ?>

<section class="event__row__edit">
    <div class="container">

        <div class="event__row__edit__title"><?= $eventTitle ?> | Ряд №<?= $row->num ?></div>
        <form action="" method="post" class="event__row__edit__form">
            <div class="form__group">
                <label for="price" class="form__label">Стоимость</label>
                <input type="text" name="price" id="price" class="form__input" value="<?= $row->price ?>">
            </div>

            <div class="form__group">
                <button class="form__btn" type="submit">Изменить</button>
            </div>
        </form>

        <div class="event__row__edit__title">Мест:<?= $seatsCount ?></div>
        <form action="" class="event__row__edit__form">
            <div class="form__label"></div>
            <div class="form__group">
                <label for="seats" class="form__label">Кол-во мест:</label>
                <input type="text" name="seats" id="seats" class="form__input" value="" placeholder="Введите количество мест">
            </div>

            <div class="form__group">
                <button class="form__btn" type="submit">Добавить</button>
            </div>
            <div class="form__group">
                <button class="form__btn event__row__edit__seats-delete-btn" type="submit">Удалить</button>
            </div>
        </form>

    </div>
</section>

<?php
include_once dirname(__FILE__) . "/../../../layouts/footer.php" ?>
