<div class="select-serial-box">
<?php if (isset($serials)): ?>
    <select id="serials-select" name="serial_id">
        <?php foreach ($serials as $serial): ?>
            <option value="<?php echo $serial->id; ?>"><?php echo $serial->title_rus; ?></option>
        <?php endforeach; ?>
    </select>
<?php endif; ?>
</div>