<?php include_once "layouts/header.php" ?>

    <section class="theaters">
        <div class="container">
            <div class="theaters">
                <ul class="theaters__list">
                    <?php /** @var array $theaters */
                    foreach ($theaters as $theater) { ?>
                        <li class="theater__list__item">
                            <a href="/theater-filter?id=<?= $theater->id ?>" class="theater__list__link"><?= $theater->title ?></a>
                        </li>
                    <?php } ?>
                </ul>
            </div>
        </div>
    </section>


<?php include_once "layouts/footer.php" ?>