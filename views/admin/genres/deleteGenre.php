<?php include_once dirname(__FILE__) . "/../../layouts/header.php" ?>
<?php include_once dirname(__FILE__) . "/../layouts/admin-before.php" ?>

    <section class="delete__genre">
        <div class="container">

            <div class="delete__genre__title">
                Вы точно хотите удалить жанр "<?= /** @var \app\Models\Genre $genre */
                $genre->title ?>"?
            </div>
            <form action="/admin/genre/deletegenre" method="post" class="form delete__genre__form">
                <input type="hidden" name="id" value="<?= $genre->id ?>">
                <div class="form__group delete__genre__btn">
                    <button class="form__btn delete__genre__btn-delete" type="submit">Удалить</button>
                </div>
                <div class="form__group delete__genre__btn">
                    <a href="/admin/genre/edit?id=<?= $genre->id ?>" class="form__btn delete__genre__btn-cancel">Отмена</a>
                </div>

            </form>

        </div>
    </section>

<?php
unset($_SESSION["genresMessages"]);
include_once dirname(__FILE__) . "/../../layouts/footer.php" ?>