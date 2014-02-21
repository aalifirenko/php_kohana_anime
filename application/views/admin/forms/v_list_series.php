<?php $model_series = ORM::factory('series')
    ->where('serial_id', "=", $serial_id)
    ->where('season_id', "=", $season_id)
    ->find_all();
?>
<table class="table table-striped">
    <thead>
    <tr>
        <th>Номер серии</th>
        <th>Edit</th>
        <th>Delete</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($model_series as $season): ?>
        <tr>
            <td><?php echo $season->num; ?></td>
            <td><a href="#">Edit</a></td>
            <td><a id="delete-series" href="#" data-id="<?php echo $season->id; ?>">Delete</a></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>