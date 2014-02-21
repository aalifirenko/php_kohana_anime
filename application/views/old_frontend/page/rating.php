<div class="anime-by-rating">
    <p class="anime-rating-title">Найти аниме по рейтингу</p>

    <div class="rating-range-block">
        <div class="ajax-loader" style="display: none"><img src="<?php echo URL::base(true) ?>media/image/ajax-loader.gif" /></div>
        <p>
            <label style="font-family: PT Sans;" for="amount">Выберите диапазон рейтинга сериалов (от 1 до 5):</label>
            <input type="text" id="anime-range" style="border: 0; color: #f6931f; font-weight: bold;" />
        </p>

        <div id="slider-range"></div>
        <button type="button" class="btn btn-info find-by-rating" data-loading-text="Загрузка...">Найти</button>
    </div>
    <div class="finded-result">

    </div>
</div>