<?php include_once dirname(__FILE__) . "/../../../layouts/header.php" ?>
<?php include_once dirname(__FILE__) . "/../../layouts/admin-before.php" ?>

<section class="event__photos__edit">
    <div class="container">
        <form action="/admin/event/photos/addPhoto"
              method="post"
              class="form edit__event__photos__form"
              enctype="multipart/form-data">

            <input type="file" name="photo" id="photo">
            <input type="hidden" name="eventId" id="eventId" value="<?= /** @var int $eventId */
            $eventId ?>">
            <button type="submit" class="form__input">Загрузить</button>

            <table>
                <?php /** @var array $photos */
                foreach ($photos as $photo) { ?>
                    <tr>
                        <td>
                            <img class="edit__event__photo" src="/img/events/<?= $eventId ?>/<?= $photo->photo ?>"
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
