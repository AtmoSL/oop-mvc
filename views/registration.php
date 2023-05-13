<?php include_once "layouts/header.php" ?>

    <section class="registration">
        <div class="container">

            <form action="/registration/register" method="post" class="form registration__form">
                <div class="form__group">
                    <label for="name" class="form__label">
                        Имя
                    </label>
                    <input class="form__input" type="text" name="name" id="name"
                           placeholder="Введите ваше имя" required>
                    <?php if(isset($_SESSION["registrationMessages"]["name"]["errorMessages"])){ ?>
                    <div class="form__error__messages">
                        <ul>
                            <?php foreach ($_SESSION["registrationMessages"]["name"]["errorMessages"] as $message){ ?>
                            <li><?=$message?></li>
                            <?php } ?>
                        </ul>
                    </div>
                    <?php }?>
                </div>
                <div class="form__group">
                    <label for="email" class="form__label">
                        Email
                    </label>
                    <input class="form__input" type="email" name="email" id="email"
                           placeholder="Введите адрес электронной почты" required>
                    <?php if(isset($_SESSION["registrationMessages"]["email"]["errorMessages"])){ ?>
                        <div class="form__error__messages">
                            <ul>
                                <?php foreach ($_SESSION["registrationMessages"]["email"]["errorMessages"] as $message){ ?>
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
                           placeholder="Введите пароль" required>
                    <?php if(isset($_SESSION["registrationMessages"]["password"]["errorMessages"])){ ?>
                        <div class="form__error__messages">
                            <ul>
                                <?php foreach ($_SESSION["registrationMessages"]["password"]["errorMessages"] as $message){ ?>
                                    <li><?=$message?></li>
                                <?php } ?>
                            </ul>
                        </div>
                    <?php }?>
                </div>
                <div class="form__group">
                    <label for="password_repeat" class="form__label">
                        Проверка пароля
                    </label>
                    <input class="form__input" type="password" name="password_repeat" id="password_repeat"
                           placeholder="Введите пароль ещё раз" required>
                    <?php if(isset($_SESSION["registrationMessages"]["password_repeat"]["errorMessages"])){ ?>
                        <div class="form__error__messages">
                            <ul>
                                <?php foreach ($_SESSION["registrationMessages"]["password_repeat"]["errorMessages"] as $message){ ?>
                                    <li><?=$message?></li>
                                <?php } ?>
                            </ul>
                        </div>
                    <?php }?>
                </div>
                <div class="form__group">
                    <button class="form__btn" type="submit">Зарегистрироваться</button>
                </div>
                <div class="registration__form__login">
                    Есть аккаунт? <a href="/login">Войдите</a>!
                </div>
            </form>

        </div>
    </section>

<?php
unset($_SESSION["registrationMessages"]);
include_once "layouts/footer.php" ?>