<?php include_once dirname(__FILE__) . "/../../layouts/header.php" ?>
<?php include_once dirname(__FILE__) . "/../layouts/admin-before.php" ?>

    <section class="all__theaters">
        <div class="container">

            <div class="all__theaters__title">
                Все жанры
            </div>
            <div class="all__theaters__table__wrapper">
                <table class="all__theaters__table">
                    <tr>
                        <td colspan="5" >
                            <a href="/admin/theater/create" class="all__theaters__add-btn">
                                добавить
                            </a>
                        </td>

                    </tr>
                    <?php /** @var array $theaters */
                    foreach ($theaters as $theater) {
                        ?>
                        <tr class="all__theater">
                            <td class="all__theater__id">
                                #<span><?= $theater->id ?></span>
                            </td>
                            <td>
                                <div class="all__theater__separator"></div>
                            </td>
                            <td class="all__theater__title">
                                <?= $theater->title ?>
                            </td>
                            <td>
                                <div class="all__theater__separator"></div>
                            </td>
                            <td><a href="/admin/theater/edit?id=<?= $theater->id ?>" class="all__theater__btn">
                                    Редактировать
                                </a></td>
                        </tr>
                    <?php } ?>
                </table>
            </div>

        </div>
    </section>

<?php include_once dirname(__FILE__) . "/../../layouts/footer.php" ?>