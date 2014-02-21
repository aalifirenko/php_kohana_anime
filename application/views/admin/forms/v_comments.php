<div class="comments">
    <h4>Новые комментарии (<?php if (isset($comments)) echo count($comments); ?>)</h4>
    <?php if (isset($comments)): ?>
        <table class="table table-hover">
        <?php foreach ($comments as $comment): ?>
        <tr>
                <td><span><?php echo $comment->text; ?></span></td>
                <td><button data-id="<?php echo $comment->id; ?>" class="save-comment">Одобрить</button></td>
                <td><button data-id="<?php echo $comment->id; ?>" class="delete-comment">Удалить</button></td>
        </tr>
        <?php endforeach; ?>
        </table>
    <?php endif; ?>
</div>