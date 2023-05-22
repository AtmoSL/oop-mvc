<?php include_once "layouts/header.php" ?>

    <section class="event">
        <div class="container">
            <div class="event__info">
                <div class="event__info__text <?= /** @var array $carousel */
                ($carousel) ? "event__info__text__absolute" : "" ?>">
                    <div class="event__info__top">
                        <div class="event__info__title">
                            <?= /** @var \app\Models\Event $event */
                            $event->title ?>
                        </div>
                        <div class="event__info__separator"></div>
                        <div class="event__info__date">
                            <?= date("d.m", strtotime($event->date)) ?>
                        </div>
                    </div>
                    <div class="event__info__theater">
                        <?= $event->theater_title ?>
                    </div>
                </div>

                <?php if ($carousel) { ?>
                    <div class="event__info__slider swiper">
                        <div class="event__info__slider__track swiper-wrapper">
                            <?php foreach ($carousel as $carouselItem) { ?>
                                <div class="event__info__slider__item swiper-slide">
                                    <div class="event__info__slider__img">
                                        <img src="/img/events/<?= $event->id ?>/<?= $carouselItem->photo ?>"
                                             alt="<?= $event->title ?>">
                                    </div>
                                </div>
                            <?php } ?>

                        </div>
                        <div class="swiper-button-prev"></div>
                        <div class="swiper-button-next"></div>
                    </div>
                <?php } ?>
            </div>

            <form action="/order/create" method="post">
                <div class="event__rows">
                    <input type="hidden" name="event_id" value="<?= $event->id ?>">
                    <?php /** @var array $rows */
                    foreach ($rows as $row) {
                        /** @var \app\Models\EventRow $row */ ?>
                        <details class="event__row">
                            <summary>Ряд №<span><?= $row->num ?></span> - <span><?= $row->price ?></span> руб.</summary>
                            <div class="event__seats">
                                <?php foreach ($row->seats as $seat) {
                                    /** @var \app\Models\EventSeat $seat */ ?>
                                    <div class="event__seat">
                                        <label class="event__seat__check">
                                            <input class="event__seat__check__input" type="checkbox"
                                                   name="<?= $seat->id ?>"
                                                <?= (!$seat->is_occupied) ? "" : "disabled" ?> id="seat-1-1">
                                            <span class="event__seat__check__box"></span>
                                            Место <?= $seat->num ?>
                                        </label>
                                    </div>
                                <?php } ?>
                        </details>
                    <?php } ?>

                </div>

                <div class="event__buy">
                    <div class="event__buy__block">
                        <div class="event__buy__count">
                            Выбрано мест: <span>3</span>
                        </div>

                        <?php if (isset($_SESSION["orderMessages"])) { ?>
                            <div class="event__order__messages">
                                <ul>
                                    <?php foreach ($_SESSION["orderMessages"] as $msg) { ?>
                                        <li><?=$msg?></li>
                                    <?php } ?>
                                </ul>
                            </div>
                        <?php } ?>

                        <button type="submit" class="event__buy__btn">
                            Оформить заказ
                        </button>
                    </div>
                </div>

            </form>


        </div>
    </section>

<?php
unset($_SESSION["orderMessages"]);
include_once "layouts/footer.php" ?>