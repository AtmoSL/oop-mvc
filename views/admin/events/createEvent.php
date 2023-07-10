<?php include_once dirname(__FILE__) . "/../../layouts/header.php" ?>
<?php include_once dirname(__FILE__) . "/../layouts/admin-before.php" ?>

    <section class="create__event">
        <div class="container">

            <form action="/admin/events/create" method="post" class="form create__event__form">
                <div class="form__group">
                    <label for="title" class="form__label">
                        Название мероприятия
                    </label>
                    <input class="form__input" type="text" name="title" id="title"
                           placeholder="Введите название мероприятия" required value="">
                    <?php if (isset($_SESSION["createEventMessages"]["title"]["errorMessages"])) { ?>
                        <div class="form__error__messages">
                            <ul>
                                <?php foreach ($_SESSION["createEventMessages"]["title"]["errorMessages"] as $message) { ?>
                                    <li><?= $message ?></li>
                                <?php } ?>
                            </ul>
                        </div>
                    <?php } ?>
                </div>

                <div class="form__group">
                    <label for="genre_id" class="form__label">Жанр</label>
                    <select name="genre_id" id="genre_id" class="form__input">
                        <?php /** @var array $genres */
                        foreach ($genres as $genre) { ?>
                            <option value="<?= $genre->id ?>">
                                <?= $genre->title ?>
                            </option>
                        <?php } ?>
                    </select>
                    <?php if (isset($_SESSION["createEventMessages"]["genre_id"]["errorMessages"])) { ?>
                        <div class="form__error__messages">
                            <ul>
                                <?php foreach ($_SESSION["createEventMessages"]["genre_id"]["errorMessages"] as $message) { ?>
                                    <li><?= $message ?></li>
                                <?php } ?>
                            </ul>
                        </div>
                    <?php } ?>
                </div>

                <div class="form__group">
                    <label for="theater_id" class="form__label">Театр</label>
                    <select name="theater_id" id="theater_id" class="form__input">
                        <?php /** @var array $theaters */
                        foreach ($theaters as $theater) { ?>
                            <option value="<?= $theater->id ?>">
                                <?= $theater->title ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>
                <?php if (isset($_SESSION["createEventMessages"]["theater_id"]["errorMessages"])) { ?>
                    <div class="form__error__messages">
                        <ul>
                            <?php foreach ($_SESSION["createEventMessages"]["theater_id"]["errorMessages"] as $message) { ?>
                                <li><?= $message ?></li>
                            <?php } ?>
                        </ul>
                    </div>
                <?php } ?>

                <div class="form__group">
                    <label for="is_published" class="form__label">Режим публикации</label>
                    <select name="is_published" id="is_published" class="form__input">
                        <option value="1">
                            Публикуется
                        </option>
                        <option value="0">
                            Не публикуется
                        </option>
                    </select>
                    <?php if (isset($_SESSION["createEventMessages"]["is_published"]["errorMessages"])) { ?>
                        <div class="form__error__messages">
                            <ul>
                                <?php foreach ($_SESSION["createEventMessages"]["is_published"]["errorMessages"] as $message) { ?>
                                    <li><?= $message ?></li>
                                <?php } ?>
                            </ul>
                        </div>
                    <?php } ?>
                </div>

                <div class="form__group">
                    <label for="date" class="form__label">Дата</label>
                    <input class="form__input" type="date" name="date" id="date" value="">
                    <?php if (isset($_SESSION["createEventMessages"]["date"]["errorMessages"])) { ?>
                        <div class="form__error__messages">
                            <ul>
                                <?php foreach ($_SESSION["createEventMessages"]["date"]["errorMessages"] as $message) { ?>
                                    <li><?= $message ?></li>
                                <?php } ?>
                            </ul>
                        </div>
                    <?php } ?>
                </div>

                <div class="form__group">
                    <button class="form__btn" type="submit">Создать</button>
                </div>
        </div>
    </section>

<?php
unset($_SESSION["createEventMessages"]);
include_once dirname(__FILE__) . "/../../layouts/footer.php" ?>