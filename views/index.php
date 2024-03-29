<?php include_once "layouts/header.php" ?>

    <section class="events">
        <div class="container">
            <?php if(isset($filterTitle)){ ?>
                <div class="events__filter-title">
                    <?= $filterTitle ?>
                </div>
            <?php }?>
            <div class="events__inner">
                <?php /** @var array $events */
                foreach ($events as $event) { ?>
                    <div class="events__card">
                        <div class="event__card__top-section">
                            <div class="event__card__top-info">
                                <div class="event__card__title">
                                    <a href="/event?id=<?= $event->id ?>">
                                        <?= $event->title ?>
                                    </a>
                                </div>
                                <div class="event__card__genre">
                                    <a href="/genre-filter?id=<?= $event->genre_id ?>">
                                        <?= $event->genre_title ?>
                                    </a>
                                </div>
                                <div class="event__card__theatre">
                                    <a href="/theater-filter?id=<?= $event->theater_id ?>">
                                        <?= $event->theater_title ?>
                                    </a>
                                </div>
                            </div>
                            <div class="event__card_date">
                                <?= date("d.m", strtotime($event->date)) ?>
                            </div>
                        </div>
                        <div class="event__card__bot-section">
                            <div class="event__card__bot-info">
                                <div class="event__card__count">
                                    Осталось: <span>3000</span>
                                </div>
                                <div class="event__card_price">
                                    <span><?= $event->price ?></span>руб.
                                </div>
                            </div>
                            <div class="event__card__btn__container">
                                <a href="/event?id=<?= $event->id ?>" class="event__card__btn">
                                    Купить
                                </a>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </section>


<?php include_once "layouts/footer.php" ?>