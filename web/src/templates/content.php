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

    

<div class="body"><?=$sanity_text($page['body'])?></div>




</article>