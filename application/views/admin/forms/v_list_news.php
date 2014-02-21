<table class="table table-striped">
    <thead>
    <tr>
        <th>Новость</th>
        <th>Edit</th>
        <th>Delete</th>
    </tr>
    </thead>
    <tbody>
    <?php if ($news): ?>
        <?php foreach ($news as $new): ?>
        <tr>
            <td><?php echo substr($new->news,0, 40); ?>...</td>
            <td><a href="<?php echo Route::url('admin_panel', array('action' => 'editnews', 'id' => $new->id)); ?>">Edit</a></td>
            <td><a class="delete-news" data-id="<?php echo $new->id; ?>" href="#">Delete</a></td>
        </tr>
        <?php endforeach; ?>
    <?php endif; ?>
    </tbody>
</table>