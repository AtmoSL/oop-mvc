<?php include_once "layouts/header.php" ?>

    <section class="login">
        <div class="container">

            <form action="" class="form login__form">
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
                    <button class="form__btn" type="submit">Войти</button>
                </div>
                <div class="login__form__registration">
                    Нет аккаунта? <a href="/registration">Зарегистрируйтесь</a>!
                </div>
            </form>

        </div>
    </section>

<?php include_once "layouts/footer.php" ?>