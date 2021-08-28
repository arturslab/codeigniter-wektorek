<?php
if (isset($posts)) {
    foreach ($posts as $d) {
        ?>

		<div class="grid-item grid-sizer cat-<?php echo $d['category_id']; ?>">
			<h4 class="category">Kategoria: <?php echo $d['category_name']; ?></h4>
			<div class="content">
                <?php echo $d['content']; ?>
			</div>
		</div>

        <?php
    }
}
?>

