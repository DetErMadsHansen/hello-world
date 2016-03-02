<div class="meta">
<?php
	echo '<em>' . __('Posted', 'organicup') . '</em> ' . get_the_time('F jS, Y');
	echo '<em> ' . __('by', 'organicup') . '</em> ' . get_the_author();
	comments_popup_link('No Comments', '1 Comment', '% Comments', 'comments-link', '');
?>
</div>