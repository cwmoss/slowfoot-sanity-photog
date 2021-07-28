<?php
layout('default');

//$links = query('*[_id=="$id"]{articles[]->, pix[]->}[0]', ['id' =>$_id]);
$links = [];
$title = $page['title'];
$subtitle = 'untertitel';
$images = [];
if ($page['gallery'] && $page['gallery']['images']) {
    $images = $page['gallery']['images'];
}

?>
<article>
    
<h2><?=$title?>  </h2>

<p></p>

<p><?=markdown($text)?></p>



	<?if ($page['sections']) {
    foreach ($page['sections'] as $section) {
        $content = $ref($section['ref']); 
        ?>
    
    <section class="section_<?=$content['_type']?>">

        <h2><?=$section['title']?></h2>
        <p><?=$content['_type']?></p>

	</section>

	<?}?>
    

<?}?>




</article>