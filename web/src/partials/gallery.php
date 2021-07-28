<?

$images = [];
if ($gallery && $gallery['images']) {
    $images = $gallery['images'];
}
?>

<div class="gallery">
	<?if ($images) {
    foreach ($images as $img) {
        $asset = $ref($img['asset']); ?>
		<div class="gallery_item">
            <img src="<?=$asset['url']?>?w=800&q=90" width="800">
            <p><?=$img['caption']?></p>
        </div>
	<?php
    }
}?>
</div>