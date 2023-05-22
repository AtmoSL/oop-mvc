<?php include_once "layouts/header.php" ?>

    <section class="user__order">
        <div class="container">

            <div class="user__order__title">
                Заказ #<span><?= /** @var \app\Models\Order $order */
                    $order->id ?></span>
            </div>

            <div class="user__order__top-wrapper">
                <div class="user__order__info">
                    <div class="user__order__info__top-line">
                        <a href="#" class="user__order__info__title">
                            <?= $order->event_title ?>
                        </a>
                        <div class="user__order__info__separator"></div>
                        <div class="user__order__info__date">
                            <?= date("d.m", strtotime($order->event_date)) ?>
                        </div>
                        <div class="user__order__info__separator-line"></div>
                        <div class="user__order__info__status">
                            <?= $order->status_title ?>
                        </div>
                    </div>

                    <div class="user__order__info__bot-line">
                        <div class="user__order__info__theater">
                            <?= $order->theater_title ?>
                        </div>
                    </div>
                </div>

                <?php if ($order->status_id != 3) { ?>
                    <div class="user__order__btn__wrapper">
                        <a href="/order/cancel?id=<?= $order->id ?>" class="user__order__btn">
                            Отменить заказ
                        </a>
                    </div>
                <?php } ?>
            </div>

            <div class="user__order__tickets">
                <div class="user__order__tickets__title">
                    Билеты:
                </div>

                <?php /** @var array $seatsAndRows */
                foreach ($seatsAndRows as $row => $seats){?>
                <div class="user__order__tickets__row">
                    Ряд <span><?= $row ?></span>: <?php foreach ($seats as $seat){?> <?= $seat ?>, <?php }?>
                </div>
                <?php }?>
            </div>

        </div>
    </section>

<?php include_once "layouts/footer.php" ?>