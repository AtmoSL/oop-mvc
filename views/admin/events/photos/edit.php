<?php include_once dirname(__FILE__) . "/../../../layouts/header.php" ?>
<?php include_once dirname(__FILE__) . "/../../layouts/admin-before.php" ?>

<section class="event__photos__edit">
    <div class="container">
        <form action="" method="post" class="form edit__event__photos__form">
            <input type="file" name="photo" id="photo">
            <button type="submit" class="form__input">Загрузить</button>
            <table>
                <?php /** @var array $photos */
                foreach ($photos as $photo) { ?>
                    <tr>
                        <td>
                            <img class="edit__event__photo" src="/img/events/<?= /** @var int $eventId */
                            $eventId ?>/<?= $photo->photo ?>"
                                 alt="Фото мероприятия <?= $eventId ?>">
                        </td>
                        <td><a class="edit__event__photo__delete" href="#">Удалить</a></td>
                    </tr>
                <?php } ?>
            </table>
        </form>
    </div>
</section>

<?php
include_once dirname(__FILE__) . "/../../../layouts/footer.php" ?>
