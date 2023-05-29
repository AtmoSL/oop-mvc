<?php include_once dirname(__FILE__) . "/../../layouts/header.php" ?>
<?php include_once dirname(__FILE__) . "/../layouts/admin-before.php" ?>

    <section class="all__genres">
        <div class="container">

            <div class="all__genres__title">
                Все жанры
            </div>
            <div class="all__genres__table__wrapper">
                <table class="all__genres__table">
                    <tr>
                        <td colspan="5" >
                            <a href="/admin/genre/create" class="all__genre__add-btn">
                                добавить
                            </a>
                        </td>

                    </tr>
                    <?php /** @var array $genres */
                    foreach ($genres as $genre) {
                        ?>
                        <tr class="all__genre">
                            <td class="all__genre__id">
                                #<span><?= $genre->id ?></span>
                            </td>
                            <td>
                                <div class="all__genre__separator"></div>
                            </td>
                            <td class="all__genre__title">
                                <?= $genre->title ?>
                            </td>
                            <td>
                                <div class="all__genre__separator"></div>
                            </td>
                            <td><a href="/admin/genre?id=<?= $genre->id ?>" class="all__genre__btn">
                                    Редактировать
                                </a></td>
                        </tr>
                    <?php } ?>
                </table>
            </div>

        </div>
    </section>

<?php include_once dirname(__FILE__) . "/../../layouts/footer.php" ?>