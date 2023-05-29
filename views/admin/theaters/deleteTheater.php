<?php include_once dirname(__FILE__) . "/../../layouts/header.php" ?>
<?php include_once dirname(__FILE__) . "/../layouts/admin-before.php" ?>

    <section class="delete__theater">
        <div class="container">

            <div class="delete__theater__title">
                Вы точно хотите удалить театр "<?= /** @var \app\Models\Theater $theater */
                $theater->title ?>"?
            </div>
            <form action="/admin/theater/deletetheater" method="post" class="form delete__theater__form">
                <input type="hidden" name="id" value="<?= $theater->id ?>">
                <div class="form__group delete__theater__btn">
                    <button class="form__btn delete__theater__btn-delete" type="submit">Удалить</button>
                </div>
                <div class="form__group delete__theater__btn">
                    <a href="/admin/theater/edit?id=<?= $theater->id ?>" class="form__btn delete__theater__btn-cancel">Отмена</a>
                </div>

            </form>

        </div>
    </section>

<?php
include_once dirname(__FILE__) . "/../../layouts/footer.php" ?>