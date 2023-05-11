<?php include_once "layouts/header.php" ?>

    <section class="registration">
        <div class="container">

            <form action="" class="form registration__form">
                <div class="form__group">
                    <label for="name" class="form__label">
                        Имя
                    </label>
                    <input class="form__input" type="text" name="name" id="name"
                           placeholder="Введите ваше имя">
                </div>
                <div class="form__group">
                    <label for="email" class="form__label">
                        Email
                    </label>
                    <input class="form__input" type="email" name="email" id="email"
                           placeholder="Введите адрес электронной почты">
                </div>
                <div class="form__group">
                    <label for="password" class="form__label">
                        Пароль
                    </label>
                    <input class="form__input" type="password" name="password" id="password"
                           placeholder="Введите пароль">
                </div>
                <div class="form__group">
                    <label for="password" class="form__label">
                        Проверка пароля
                    </label>
                    <input class="form__input" type="password" name="password" id="password"
                           placeholder="Введите пароль ещё раз">
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

<?php include_once "layouts/footer.php" ?>