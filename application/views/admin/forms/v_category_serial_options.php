<?php if (count($options) > 0): ?>
    <div class="category-serial-option-item">
        <label>Популярное</label>
        <input type="checkbox" name="popular" <?php if ($options->popular == 1)  echo 'checked="checked" value="1"'; ?> value="1" />
    </div>
    <hr>
    <div class="category-serial-option-item">
        <label>Хит</label>
        <input type="checkbox" name="hits" <?php if ($options->hits == 1)  echo 'checked="checked" value="1"'; ?> value="1"/>
    </div>
    <hr>
    <div class="category-serial-option-item">
        <label>Онгоинг</label>
        <input type="checkbox" name="ongoing" <?php if ($options->ongoing == 1)  echo 'checked="checked" value="1"'; ?> value="1" />
    </div>
    <hr>
    <div class="category-serial-option-item">
        <label>Комедия</label>
        <input type="checkbox" name="comedy" <?php if ($options->comedy == 1)  echo 'checked="checked"'; ?> value="1" />
    </div>
    <hr>
    <div class="category-serial-option-item">
        <label>Мистика</label>
        <input type="checkbox" name="mystic" <?php if ($options->mystic == 1)  echo 'checked="checked"'; ?> value="1" />
    </div>
    <hr>
    <div class="category-serial-option-item">
        <label>Романтика</label>
        <input type="checkbox" name="romantic" <?php if ($options->romantic == 1)  echo 'checked="checked"'; ?> value="1" />
    </div>
    <hr>
    <div class="category-serial-option-item">
        <label>Драма</label>
        <input type="checkbox" name="drama" <?php if ($options->drama == 1)  echo 'checked="checked"'; ?> value="1" />
    </div>
    <hr>
    <div class="category-serial-option-item">
        <label>Детектив</label>
        <input type="checkbox" name="detective" <?php if ($options->detective == 1)  echo 'checked="checked"'; ?> value="1" />
    </div>
    <hr>
    <div class="category-serial-option-item">
        <label>Боевик</label>
        <input type="checkbox" name="boevik" <?php if ($options->boevik == 1)  echo 'checked="checked"'; ?> value="1" />
    </div>
    <hr>
    <div class="category-serial-option-item">
        <label>Фантастика</label>
        <input type="checkbox" name="fantastic" <?php if ($options->fantastic == 1)  echo 'checked="checked"'; ?> value="1" />
    </div>
    <hr>
    <div class="category-serial-option-item">
        <label>Озвучено AniNice</label>
        <input type="checkbox" name="aninice" <?php if ($options->aninice == 1)  echo 'checked="checked"'; ?> value="1" />
    </div>
    <div class="category-serial-option-item">
        <label>С субтитрами</label>
        <input type="checkbox" name="sub" <?php if ($options->sub == 1)  echo 'checked="checked"'; ?> value="1" />
    </div>
    <div class="category-serial-option-item">
        <label>Топ 10</label>
        <input type="checkbox" name="top_10" <?php if ($options->sub == 1)  echo 'checked="checked"'; ?> value="1" />
    </div>
<?php else: ?>
    <div class="category-serial-option-item">
        <label>Популярное</label>
        <input type="checkbox" name="popular" value="1" />
    </div>
    <hr>
    <div class="category-serial-option-item">
        <label>Хит</label>
        <input type="checkbox" name="hits" value="1" />
    </div>
    <hr>
    <div class="category-serial-option-item">
        <label>Онгоинг</label>
        <input type="checkbox" name="ongoing" value="1" />
    </div>
    <hr>
    <div class="category-serial-option-item">
        <label>Комедия</label>
        <input type="checkbox" name="comedy" value="1" />
    </div>
    <hr>
    <div class="category-serial-option-item">
        <label>Мистика</label>
        <input type="checkbox" name="mystic" value="1" />
    </div>
    <hr>
    <div class="category-serial-option-item">
        <label>Романтика</label>
        <input type="checkbox" name="romantic" value="1" />
    </div>
    <hr>
    <div class="category-serial-option-item">
        <label>Драма</label>
        <input type="checkbox" name="drama" value="1" />
    </div>
    <hr>
    <div class="category-serial-option-item">
        <label>Детектив</label>
        <input type="checkbox" name="detective" value="1" />
    </div>
    <hr>
    <div class="category-serial-option-item">
        <label>Боевик</label>
        <input type="checkbox" name="boevik" value="1" />
    </div>
    <hr>
    <div class="category-serial-option-item">
        <label>Фантастика</label>
        <input type="checkbox" name="fantastic" value="1" />
    </div>
    <hr>
    <div class="category-serial-option-item">
        <label>Озвучено AniNice</label>
        <input type="checkbox" name="aninice" value="1" />
    </div>
    <div class="category-serial-option-item">
        <label>С субтитрами </label>
        <input type="checkbox" name="sub" value="1" />
    </div>
    <div class="category-serial-option-item">
        <label>Топ 10 </label>
        <input type="checkbox" name="top_10" value="1" />
    </div>
<?php endif; ?>