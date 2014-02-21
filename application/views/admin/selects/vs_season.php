<div class="select-season-box">
<?php if (isset($seasons)): ?>
    <select id="season-select" name="season_id">
        <?php foreach ($seasons as $season): ?>
            <option value="<?php echo $season->id; ?>"><?php echo $season->title; ?></option>
        <?php endforeach; ?>
    </select>
    <button class="btn" id="season-select-btn">Выбрать</button>
    <button class="btn" id="display-all-serues">Показать все серии сезона</button>
<?php endif; ?>
</div>