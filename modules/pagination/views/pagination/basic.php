<div class="pagination">
<ul>
	<?php if ($first_page !== FALSE): ?>
    <li><a href="<?php echo HTML::chars($page->url($first_page)) ?>" rel="first"><?php echo __('первая') ?></a></li>
	<?php else: ?>
    <li><a href="#"><?php echo __('<') ?></a></li>
	<?php endif ?>

	<?php if ($previous_page !== FALSE): ?>
    <li><a href="<?php echo HTML::chars($page->url($previous_page)) ?>" rel="prev"><?php echo __('пред.') ?></a></li>
	<?php else: ?>
    <li><a href="#"><?php echo __('<<') ?></a></li>
	<?php endif ?>

	<?php for ($i = 1; $i <= $total_pages; $i++): ?>

		<?php if ($i == $current_page): ?>
    <li><a href="#"><strong><?php echo $i ?></strong></a></li>
		<?php else: ?>
    <li><a href="<?php echo HTML::chars($page->url($i)) ?>"><?php echo $i ?></a></li>
		<?php endif ?>

	<?php endfor ?>

	<?php if ($next_page !== FALSE): ?>
    <li><a href="<?php echo HTML::chars($page->url($next_page)) ?>" rel="next"><?php echo __('>>') ?></a></li>
	<?php else: ?>
    <li><a href="#"><?php echo __('>>') ?></a></li>
	<?php endif ?>

	<?php if ($last_page !== FALSE): ?>
    <li><a href="<?php echo HTML::chars($page->url($last_page)) ?>" rel="last"><?php echo __('>') ?></a></li>
	<?php else: ?>
    <li><a href="#"><?php echo __('>') ?></a></li>
	<?php endif ?>
</ul>
</div><!-- .pagination -->