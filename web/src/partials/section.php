<?php
/*
	sections in pagebuilder pages
*/

$page = $ref($section['ref']); 
?>
    
 <section class="section_<?=$page['_type']?>">

     <h2><?=$section['title']?></h2>
     <p><?=$page['_type']?></p>

     <?if($page['_type']=='content'){?>

     	<div class="section_content">
     		<div class="body"><?=$sanity_text($page['body'])?></div>
     	</div>

     <?}?>

     <?if($page['_type']=='gallery_page'){
     	$asset = $ref($page['gallery']['images'][0]['asset']);

     	?>
            
          <img src="<?=$asset['url']?>?w=600&h=600&q=90" width="400">

     <?}?>

</section>