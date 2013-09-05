<?php session_start(); 
  if(isset($_SESSION['name']) AND isset($_SESSION['psw'])) {
        $_SESSION['connection']=1;
    } else {
        $_SESSION['connextion']=0;
    }
?><!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?php echo $title; ?></title>

<link rel="stylesheet" href="http://yui.yahooapis.com/pure/0.2.1/pure-min.css">

<link rel="stylesheet" href="<?php echo $path_style; ?>default.css">
    
<script type="text/javascript" src="<?php echo $path_style; ?>js/menu.js"></script>

<script src="http://use.typekit.net/ajf8ggy.js"></script>
<script>
    try { Typekit.load(); } catch (e) {}
</script>

</head>
<body>

<div>
    <div class="header">
        <div class="pure-menu pure-menu-open pure-menu-horizontal">
            <a class="pure-menu-heading" href="">Photo Gallery</a>
            <?php
                show_pages("","");
            ?>
        </div>
    </div>

    <div class="pure-g-r">
        <div class="pure-u-1-3 photo-box">
            <div class="#">
            <img src="http://lucamailhol.fr/content/Photographies/Observation/IMG_4660.jpg" alt="Coucou"/>
            </div>
        </div>

        <div class="pure-u-2-3 text-box">
            <div class="l-box">
                <h1 class="text-box-head"><?php echo $title; ?></h1>
                <p class="text-box-subhead">Plein de jolies images</p>
            </div>
        </div>

        <div class="pure-u-1-3">
            <div class="l-box">
                <div class="menu">
                    <?php show_categories("","","","","", 1); ?> 
                </div>
            </div>
        </div>
        <div class="pure-u-2-3">
            <div class="l-box">
                <div class="l-centered">
                <?php if(comment_exist()==1) {
                    echo "<blockquote>";
                        show_comment();
                    echo "</blockquote>";
                } elseif(comment_exist()==2) { create_comment(); }?> 
		        <?php show_body(); ?>
                </div>
            </div>
        </div>
    </div>

    <div class="footer">
        <?php echo $footer_text; ?>
    </div>
</div>

<script src="http://yui.yahooapis.com/3.10.1/build/yui/yui-min.js"></script>
<script>
YUI().use('node-base', 'node-event-delegate', function (Y) {
    // This just makes sure that the href="#" attached to the <a> elements
    // don't scroll you back up the page.
    Y.one('body').delegate('click', function (e) {
        e.preventDefault();
    }, 'a[href="#"]');
});
</script>



</body>
</html>
