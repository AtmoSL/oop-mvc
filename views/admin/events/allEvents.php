<?php include_once dirname(__FILE__) . "/../../layouts/header.php" ?>
<?php include_once dirname(__FILE__) . "/../layouts/admin-before.php" ?>

    <section class="all__events">
        <div class="container">

            <div class="all__events__top__wrapper">
                <div class="all__events__title">
                    Все мероприятия —
                </div>
                <a href="/admin/events/new" class="all__events__add-event__btn">Создать новое</a>
            </div>
            <div class="all__events__table__wrapper">
                <table class="all__events__table">
                    <?php /** @var array $events */
                    foreach ($events as $event) {
                        ?>
                        <tr class="all__event">
                            <td class="all__event__id">
                                #<span><?= $event->id ?></span>
                            </td>
                            <td>
                                <div class="all__event__separator"></div>
                            </td>
                            <td class="all__event__title">
                                <?= $event->title ?>
                            </td>
                            <td>
                                <div class="all__event__separator"></div>
                            </td>
                            <td class="all__event__theater">
                                <?= $event->theater_title ?>
                            </td>
                            <td>
                                <div class="all__event__separator"></div>
                            </td>
                            <td class="all__event__genre">
                                    <?= $event->genre_title ?>
                            </td>
                            <td>
                                <div class="all__event__separator"></div>
                            </td>
                            <td class="all__event__date">
                                <?= date("d.m", strtotime($event->date)) ?>
                            </td>
                            <td>
                                <div class="all__event__separator"></div>
                            </td>
                            <td><a href="/admin/event/edit?id=<?= $event->id ?>" class="all__event__btn">
                                    Редактировать
                                </a></td>
                        </tr>
                    <?php } ?>
                </table>
            </div>

        </div>
    </section>

<?php include_once dirname(__FILE__) . "/../../layouts/footer.php" ?>