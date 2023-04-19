<?php include_once "layouts/header.php" ?>

    <section class="event">
        <div class="container">
            <div class="event__info">
                <div class="event__info__text">
                    <div class="event__info__top">
                        <div class="event__info__title">
                            Бешенные деньги
                        </div>
                        <div class="event__info__separator"></div>
                        <div class="event__info__date">
                            28.05
                        </div>
                    </div>
                    <div class="event__info__theater">
                        Театр комедии им. Акимова
                    </div>
                </div>
                <!--                <div class="event__info__img">-->
                <!--                    <img src="/img/events/event.png" alt="">-->
                <!--                </div>-->

                <div class="event__info__slider swiper">

                    <div class="event__info__slider__track swiper-wrapper">

                        <div class="event__info__slider__item swiper-slide">
                            <div class="event__info__slider__img">
                                <img src="/img/events/event.png" alt="">
                            </div>
                        </div>
                        <div class="event__info__slider__item swiper-slide">
                            <div class="event__info__slider__img">
                                <img src="/img/events/event.png" alt="">
                            </div>
                        </div>
                        <div class="event__info__slider__item swiper-slide">
                            <div class="event__info__slider__img">
                                <img src="/img/events/event.png" alt="">
                            </div>
                        </div>


                    </div>


                    <div class="swiper-button-prev"></div>
                    <div class="swiper-button-next"></div>

                </div>
            </div>

            <div class="event__rows">
                <details class="event__row">
                    <summary>Ряд №1</summary>
                    <div class="event__seats">
                        <div class="event__seat">
                            <label class="event__seat__check">
                                <input class="event__seat__check__input" type="checkbox" name="seat-1-2" id="seat-1-1">
                                <span class="event__seat__check__box"></span>
                                Место 1
                            </label>
                        </div>
                        <div class="event__seat">
                            <label class="event__seat__check">
                                <input disabled class="event__seat__check__input" type="checkbox" name="seat-1-2"
                                       id="seat-1-1">
                                <span class="event__seat__check__box"></span>
                                Место 2
                            </label>
                        </div>
                    </div>
                </details>
                <details class="event__row">
                    <summary>Ряд №1</summary>
                    <div class="event__seats">
                        <div class="event__seat">
                            <label class="event__seat__check">
                                <input class="event__seat__check__input" type="checkbox" name="seat-1-2" id="seat-1-1">
                                <span class="event__seat__check__box"></span>
                                Место 1
                            </label>
                        </div>
                        <div class="event__seat">
                            <label class="event__seat__check">
                                <input disabled class="event__seat__check__input" type="checkbox" name="seat-1-2"
                                       id="seat-1-1">
                                <span class="event__seat__check__box"></span>
                                Место 2
                            </label>
                        </div>
                    </div>
                </details>
                <details class="event__row">
                    <summary>Ряд №1</summary>
                    <div class="event__seats">
                        <div class="event__seat">
                            <label class="event__seat__check">
                                <input class="event__seat__check__input" type="checkbox" name="seat-1-2" id="seat-1-1">
                                <span class="event__seat__check__box"></span>
                                Место 1
                            </label>
                        </div>
                        <div class="event__seat">
                            <label class="event__seat__check">
                                <input disabled class="event__seat__check__input" type="checkbox" name="seat-1-2"
                                       id="seat-1-1">
                                <span class="event__seat__check__box"></span>
                                Место 2
                            </label>
                        </div>
                    </div>
                </details>
            </div>

            <div class="event__buy">
                <div class="event__buy__block">
                    <div class="event__buy__count">
                        Выбрано мест: <span>3</span>
                    </div>
                    <a href class="event__buy__btn">
                        Оформить заказ
                    </a>
                </div>
            </div>

        </div>
    </section>

<?php include_once "layouts/footer.php" ?>