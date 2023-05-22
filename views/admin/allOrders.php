<?php include_once dirname(__FILE__)."/../layouts/header.php" ?>

    <section class="all__orders">
        <div class="container">

            <div class="all__orders__title">
                Все заказы
            </div>
            <div class="all__orders__table__wrapper">
                <table class="all__orders__table">
                    <?php /** @var array $orders */
                    foreach ($orders as $order) {
                        ?>
                        <tr class="all__order">
                            <td class="all__order__id">
                                #<span><?= $order->id ?></span>
                            </td>
                            <td>
                                <div class="all__order__separator"></div>
                            </td>
                            <td class="all__order__id">
                                <?= $order->user_name ?>
                            </td>
                            <td>
                                <div class="all__order__separator"></div>
                            </td>
                            <td class="all__order__title">
                                <a href="/event?id=<?= $order->event_id ?>">
                                    <?= $order->event_title ?>
                                </a>
                            </td>
                            <td>
                                <div class="all__order__separator"></div>
                            </td>
                            <td class="all__order__date">
                                <?= date("d.m", strtotime($order->event_date)) ?>
                            </td>
                            <td>
                                <div class="all__order__separator"></div>
                            </td>
                            <td class="all__order__seats">
                                <span><?= $order->seats ?></span> мест
                            </td>
                            <td>
                                <div class="all__order__separator"></div>
                            </td>
                            <td class="all__order__price">
                                <span><?= $order->total_price ?></span> рублей
                            </td>
                            <td>
                                <div class="all__order__separator"></div>
                            </td>
                            <td><a href="/admin/order?id=<?= $order->id ?>" class="all__order__btn">
                                    Перейти к заказу
                                </a></td>
                        </tr>
                    <?php } ?>
                </table>
            </div>

        </div>
    </section>

<?php include_once dirname(__FILE__)."/../layouts/footer.php" ?>