<?php include_once dirname(__FILE__) . "/../../layouts/header.php" ?>
<?php include_once dirname(__FILE__) . "/../layouts/admin-before.php" ?>

    <section class="create__theater">
        <div class="container">

            <form action="/admin/theater/createtheater" method="post" class="form create__theater__form">
                <div class="form__group">
                    <label for="title" class="form__label">
                        Название театра
                    </label>
                    <input class="form__input" type="text" name="title" id="title"
                           placeholder="Введите название театра" required>
                    <?php if(isset($_SESSION["theatersMessages"]["title"]["errorMessages"])){ ?>
                        <div class="form__error__messages">
                            <ul>
                                <?php foreach ($_SESSION["theatersMessages"]["title"]["errorMessages"] as $message){ ?>
                                    <li><?=$message?></li>
                                <?php } ?>
                            </ul>
                        </div>
                    <?php }?>
                </div>
                <div class="form__group">
                    <button class="form__btn" type="submit">Создать</button>
                </div>
            </form>

        </div>
    </section>

<?php
unset($_SESSION["theatersMessages"]);
include_once dirname(__FILE__) . "/../../layouts/footer.php" ?>