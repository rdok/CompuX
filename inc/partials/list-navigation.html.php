<?php
/**
* The code in this file is view code, not model code or controller code, so its primary 
* purpose is to define the HTML for a particular section of a page. 
* Convetion name these files to  .html.php at the end.
*/
?>

<div class="pagination">
	<?php $i = 0; ?>
	<?php while ($i < $total_pages) : ?>
		<?php $i += 1; ?>
		<?php if ($i == $current_page) : ?>
			<span><?php echo $i; ?></span>
		<?php else : ?>
			<a href="./?pg=<?php echo $i; ?>"><?php echo $i; ?></a>
		<?php endif; ?>
	<?php endwhile; ?>
</div>