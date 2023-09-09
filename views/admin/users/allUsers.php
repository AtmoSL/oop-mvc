<?php include_once dirname(__FILE__) . "/../../layouts/header.php" ?>
<?php include_once dirname(__FILE__) . "/../layouts/admin-before.php" ?>

<section class="all__users">
    <div class="container">

        <div class="all__users__title">
            Все администраторы
        </div>
        <div class="all__users__wrapper">
            <form action="" class="users__add">
                <div class="form__group">
                    <input class="form__input users__add__input" type="email" name="email" id="email"
                           placeholder="Email пользователя">
                    <?php if (isset($_SESSION["loginMessages"]["email"]["errorMessages"])) { ?>
                        <div class="form__error__messages">
                            <ul>
                                <?php foreach ($_SESSION["loginMessages"]["email"]["errorMessages"] as $message) { ?>
                                    <li><?= $message ?></li>
                                <?php } ?>
                            </ul>
                        </div>
                    <?php } ?>
                </div>
                <div class="form__group">
                    <button class="form__btn" type="submit">Добавить администратора</button>
                </div>
            </form>

            <table class="all__users__list">
                <?php /** @var array $admins */
                foreach ($admins as $admin) {?>

                <tr class="all__users__row">
                    <td class="all__users__email">
                        <?= $admin->email ?>
                    </td>
                    <td class="all__users__separator"></td>
                    <td class="all__users__delete">
                        <?php if(\vendor\Evd\Main\Auth::userId() != $admin->id) {?>
                        <a href="/admin/users/delete?id=<?= $admin->id ?>" class="all__users__btn">Удалить</a>
                        <?php }else {?>
                            <div class="all__users__btn-no-active ">
                                Удалить
                            </div>
                        <?php }?>
                    </td>
                </tr>

                <?php } ?>
            </table>
        </div>

    </div>
</section>

<?php include_once dirname(__FILE__) . "/../../layouts/footer.php" ?>