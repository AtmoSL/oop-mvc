<?php include_once dirname(__FILE__) . "/../../layouts/header.php" ?>
<?php include_once dirname(__FILE__) . "/../layouts/admin-before.php" ?>

    <section class="edit__genre">
        <div class="container">

            <form action="/admin/genre/editgenre" method="post" class="form edit__genre__form">
                <div class="form__group">
                    <label for="title" class="form__label">
                        Название жанра
                    </label>
                    <input class="form__input" type="text" name="title" id="title"
                           placeholder="Введите название жанра" required value="<?= $genreTitle ?>">
                    <?php if(isset($_SESSION["genresMessages"]["title"]["errorMessages"])){ ?>
                        <div class="form__error__messages">
                            <ul>
                                <?php foreach ($_SESSION["genresMessages"]["title"]["errorMessages"] as $message){ ?>
                                    <li><?=$message?></li>
                                <?php } ?>
                            </ul>
                        </div>
                    <?php }?>
                </div>
                <div class="form__group">
                    <button class="form__btn" type="submit">Изменить</button>
                </div>
            </form>

        </div>
    </section>

<?php
unset($_SESSION["genresMessages"]);
include_once dirname(__FILE__) . "/../../layouts/footer.php" ?>