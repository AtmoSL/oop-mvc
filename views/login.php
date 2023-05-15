<?php include_once "layouts/header.php" ?>

    <section class="login">
        <div class="container">

            <form action="/login/login" method="post" class="form login__form">
                <div class="form__group">
                    <label for="email" class="form__label">
                        Email
                    </label>
                    <input class="form__input" type="email" name="email" id="email"
                           placeholder="Введите адрес электронной почты">
                    <?php if(isset($_SESSION["loginMessages"]["email"]["errorMessages"])){ ?>
                        <div class="form__error__messages">
                            <ul>
                                <?php foreach ($_SESSION["loginMessages"]["email"]["errorMessages"] as $message){ ?>
                                    <li><?=$message?></li>
                                <?php } ?>
                            </ul>
                        </div>
                    <?php }?>
                </div>
                <div class="form__group">
                    <label for="password" class="form__label">
                        Пароль
                    </label>
                    <input class="form__input" type="password" name="password" id="password"
                           placeholder="Введите пароль">
                    <?php if(isset($_SESSION["loginMessages"]["password"]["errorMessages"])){ ?>
                        <div class="form__error__messages">
                            <ul>
                                <?php foreach ($_SESSION["loginMessages"]["password"]["errorMessages"] as $message){ ?>
                                    <li><?=$message?></li>
                                <?php } ?>
                            </ul>
                        </div>
                    <?php }?>
                </div>
                <div class="form__group">
                    <button class="form__btn" type="submit">Войти</button>
                </div>
                <div class="login__form__registration">
                    Нет аккаунта? <a href="/registration">Зарегистрируйтесь</a>!
                </div>
            </form>

        </div>
    </section>

<?php
unset($_SESSION["loginMessages"]);
include_once "layouts/footer.php" ?>