<page-query>
    *(_type == "gallery_page")
    # order(title) 
    limit(12)
</page-query>

<?php
layout('default');

//paginate("artist");

// artist(tags in ["top"]) order(familyname) limit(20)
$content = $query('content(slug.current=="works")');
#$content = $query('*(_type == "content" && slug.current=="works")')[0];

// first value
if ($content) {
    $content = reset($content);
}


?>

<h1>Work</h1>

<div class="body"><?=$sanity_text($content['body'])?></div>

<section>
    <?foreach ($page as $gallery) {
    $asset = $ref($gallery['gallery']['images'][0]['asset']); ?>
    
        <aside>
            <h3><a href="<?=$path($gallery)?>"><?=$gallery['title']?></a></h3>
            
            <img src="<?=$asset['url']?>?w=400&h=400&q=90" width="400">
        </aside>
    <?php
}?>

</section>