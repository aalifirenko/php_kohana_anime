<div class="relise-page">
    <?php if (Session::instance()->get_once('add_relise') == '1'): ?>
        <div class="alert alert-success">
            Релизы обновлены
        </div>
    <?php elseif (Session::instance()->get_once('add_relise') == '0'): ?>
        <div class="alert alert-error">
            Ошибка добавления
        </div>
    <?php endif; ?>
    <form action="" method="POST">
    <textarea id="relise-page" name="text">
        <?php echo $relise->text; ?>
    </textarea>
        <button class="btn" type="submit">Сохранить</button>
    </form>
</div>