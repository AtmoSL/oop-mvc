<?php include_once dirname(__FILE__) . "/../layouts/header.php" ?>

    <section class="order">
        <div class="container">

            <div class="order__title">
                Заказ #<span><?= /** @var \app\Models\Order $order */
                    $order->id ?></span>
            </div>

            <div class="order__user__info">
                <div class="order__user__name">
                    <?= /** @var \app\Models\User $userInfo */
                    $userInfo->name ?>
                </div>
                <div class="order__user__separator"></div>
                <div class="order__user__email">
                    <?= $userInfo->email ?>
                </div>
            </div>
            <form action="#" method="post">
                <div class="order__top-wrapper">
                    <div class="order__info">
                        <div class="order__info__top-line">
                            <a href="#" class="order__info__title">
                                <?= $order->event_title ?>
                            </a>
                            <div class="order__info__separator"></div>
                            <div class="order__info__date">
                                <?= date("d.m", strtotime($order->event_date)) ?>
                            </div>
                            <div class="order__info__separator-line"></div>
                            <div class="order__info__status">
                                <?php if ($order->status_id != 3) { ?>
                                    <label for="status_id"></label><select name="status_id" id="status_id">
                                        <?php foreach ($statuses as $status) { ?>
                                            <option value="<?= $status->id ?>"
                                                <?= ($order->status_id == $status->id) ? "selected" : "" ?> ><?= $status->title ?></option>
                                        <?php } ?>

                                    </select>
                                <?php } else { ?>
                                    <?= $order->status_title ?>
                                <?php } ?>
                            </div>
                        </div>

                        <div class="order__info__bot-line">
                            <div class="order__info__theater">
                                <?= $order->theater_title ?>
                            </div>
                        </div>
                    </div>

                    <?php if ($order->status_id != 3) { ?>
                        <div class="order__btn__wrapper">
                            <button type="submit" class="order__btn">
                                Изменить статус
                            </button>
                        </div>
                    <?php } ?>
                </div>

            </form>

            <div class="order__tickets">
                <div class="order__tickets__title">
                    Билеты:
                </div>

                <?php /** @var array $seatsAndRows */
                foreach ($seatsAndRows as $row => $seats) {
                    ?>
                    <div class="order__tickets__row">
                        Ряд <span><?= $row ?></span>: <?php foreach ($seats as $seat) { ?> <?= $seat ?>, <?php } ?>
                    </div>
                <?php } ?>
            </div>


        </div>
    </section>

<?php include_once dirname(__FILE__) . "/../layouts/footer.php" ?>