<?php
$settings = $get('site_settings');
$title = $settings['title'];
$nav = $ref($settings['nav_main']);
$fnav = $ref($settings['nav_footer']);
?>
<!doctype html>
<html>
<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=yes">
    <link rel="SHORTCUT ICON" href="/favicon.ico">
    <link rel="stylesheet" href="<?=path_asset('/css/app.css', true)?>" type="text/css">
    <script src="<?=path_asset('/js/jquery-3.6.0.min.js')?>"></script>
    <script src="<?=path_asset('/js/app.js')?>"></script>
    <title><?=$title?></title>

</head>
<body data-barba="wrapper">
    <header>
<nav>
    <span class="logo"><a href="<?=path_page('/')?>"><?=$title?></a></span>
    <ul>
    <?foreach ($nav['items'] as $n) {
    ?>
        <li><?=$sanity_link($n)?></li>
    <?php
}?>
    
    </ul>
</nav>
</header>

<main data-barba="container" data-barba-namespace="home">

    <?=$content?>

</main>

<footer>
    <div class="content">
&copy; 2021

<?foreach ($fnav['items'] as $n) {?>
    <p><?=$sanity_link($n)?></p>
<?}?>

</div>
</footer>

</body>

</html>