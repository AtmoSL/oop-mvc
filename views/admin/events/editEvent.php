<?php include_once dirname(__FILE__) . "/../../layouts/header.php" ?>
<?php include_once dirname(__FILE__) . "/../layouts/admin-before.php" ?>

    <section class="edit__event">
        <div class="container">

            <form action="/admin/event/editevent" method="post" class="form edit__event__form">
                <div class="form__group">
                    <label for="title" class="form__label">
                        Название мероприятия
                    </label>
                    <input type="hidden" name="id" value="<?= /** @var \app\Models\Event $event */
                    $event->id ?>">
                    <input class="form__input" type="text" name="title" id="title"
                           placeholder="Введите название мероприятия" required value="<?= $event->title ?>">
                    <?php if (isset($_SESSION["editEventMessages"]["title"]["errorMessages"])) { ?>
                        <div class="form__error__messages">
                            <ul>
                                <?php foreach ($_SESSION["editEventMessages"]["title"]["errorMessages"] as $message) { ?>
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
                            <option value="<?= $genre->id ?>" <?= ($event->genre_id == $genre->id) ? "selected" : "" ?>>
                                <?= $genre->title ?>
                            </option>
                        <?php } ?>
                    </select>
                    <?php if (isset($_SESSION["editEventMessages"]["genre_id"]["errorMessages"])) { ?>
                        <div class="form__error__messages">
                            <ul>
                                <?php foreach ($_SESSION["editEventMessages"]["genre_id"]["errorMessages"] as $message) { ?>
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
                            <option value="<?= $theater->id ?>" <?= ($event->theater_id == $theater->id) ? "selected" : "" ?>>
                                <?= $theater->title ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>
                <?php if (isset($_SESSION["editEventMessages"]["theater_id"]["errorMessages"])) { ?>
                    <div class="form__error__messages">
                        <ul>
                            <?php foreach ($_SESSION["editEventMessages"]["theater_id"]["errorMessages"] as $message) { ?>
                                <li><?= $message ?></li>
                            <?php } ?>
                        </ul>
                    </div>
                <?php } ?>

                <div class="form__group">
                    <label for="is_published" class="form__label">Режим публикации</label>
                    <select name="is_published" id="is_published" class="form__input">
                        <option value="1" <?= ($event->is_published) ? "selected" : "" ?>>
                            Публикуется
                        </option>
                        <option value="0" <?= (!$event->is_published) ? "selected" : "" ?>>
                            Не публикуется
                        </option>
                    </select>
                    <?php if (isset($_SESSION["editEventMessages"]["is_published"]["errorMessages"])) { ?>
                        <div class="form__error__messages">
                            <ul>
                                <?php foreach ($_SESSION["editEventMessages"]["is_published"]["errorMessages"] as $message) { ?>
                                    <li><?= $message ?></li>
                                <?php } ?>
                            </ul>
                        </div>
                    <?php } ?>
                </div>

                <div class="form__group">
                    <label for="date" class="form__label">Дата</label>
                    <input class="form__input" type="date" name="date" id="date" value="<?= $event->date ?>">
                    <?php if (isset($_SESSION["editEventMessages"]["date"]["errorMessages"])) { ?>
                        <div class="form__error__messages">
                            <ul>
                                <?php foreach ($_SESSION["editEventMessages"]["date"]["errorMessages"] as $message) { ?>
                                    <li><?= $message ?></li>
                                <?php } ?>
                            </ul>
                        </div>
                    <?php } ?>
                </div>

                <div class="form__group">
                    <button class="form__btn" type="submit">Изменить</button>
                </div>



            </form>

            <div class="rows__edit">
                <a class="rows__edit__btn" href="#">Редактировать ряды</a>
            </div><div class="rows__edit">
                <a class="rows__edit__btn" href="/admin/event/photos/edit?id=<?= $event->id ?>">Редактировать фото</a>
            </div>
<!--            <form action="">-->
<!--                <div class="form__group">-->
<!--                    <details class="form__input">-->
<!--                        <summary>Карусель фото</summary>-->
<!--                        <input type="file" name="photo" id="photo">-->
<!--                        <table>-->
<!--                            --><?php ///** @var array $photos */
//                            foreach ($photos as $photo) { ?>
<!--                                <tr>-->
<!--                                    <td>-->
<!--                                        <img class="edit__event__photo" src="/img/events/--><?php //= $event->id ?><!--/--><?php //= $photo->photo ?><!--"-->
<!--                                             alt="--><?php //= $event->title ?><!--">-->
<!--                                    </td>-->
<!--                                    <td><a class="edit__event__photo__delete" href="#">Удалить</a></td>-->
<!--                                </tr>-->
<!--                            --><?// } ?>
<!--                        </table>-->
<!--                    </details>-->
<!--                </div>-->
<!--            </form>-->
        </div>
    </section>

<?php
unset($_SESSION["editEventMessages"]);
include_once dirname(__FILE__) . "/../../layouts/footer.php" ?>