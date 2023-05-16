<?php include_once "layouts/header.php" ?>

    <section class="user__orders">
        <div class="container">

            <div class="user__orders__title">
                Заказы
            </div>
<div class="user__orders__table__wrapper">
    <table class="user__orders__table">
        <?php /** @var array $orders */
        foreach ($orders as $order){?>
            <tr class="user__order">
                <td class="user__order__id">
                    #<span><?=$order->id?></span>
                </td>
                <td>
                    <div class="user__order__separator"></div>
                </td>
                <td class="user__order__title">
                    <a href="/event?id=<?= $order->event_id ?>">
                        <?=$order->event_title?>
                    </a>
                </td>
                <td>
                    <div class="user__order__separator"></div>
                </td>
                <td class="user__order__date">
                    <?= date("d.m", strtotime($order->event_date)) ?>
                </td>
                <td>
                    <div class="user__order__separator"></div>
                </td>
                <td class="user__order__seats">
                    <span><?= $order->seats ?></span> мест
                </td>
                <td>
                    <div class="user__order__separator"></div>
                </td>
                <td class="user__order__price">
                    <span><?=$order->total_price?></span> рублей
                </td>
                <td>
                    <div class="user__order__separator"></div>
                </td>
                <td><a href="/order?id=<?=$order->id?>" class="user__order__btn">
                        Перейти к заказу
                    </a></td>
            </tr>
        <?php }?>
    </table>
</div>

        </div>
    </section>

<?php include_once "layouts/footer.php" ?>