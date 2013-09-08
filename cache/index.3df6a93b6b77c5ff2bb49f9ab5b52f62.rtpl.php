<?php if(!class_exists('raintpl')){exit;}?><!--&lt;?php session_start(); 
  if(isset($_SESSION['name']) AND isset($_SESSION['psw'])) {
        $_SESSION['connection']=1;
    } else {
        $_SESSION['connection']=0;
    }
?&gt;--><!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><!--&lt;?php echo $title; ?&gt;--></title>

<link rel="stylesheet" href="http://yui.yahooapis.com/pure/0.2.1/pure-min.css">

<link rel="stylesheet" href="resources/template/default/default.css">
    
<script type="text/javascript" src="resources/template/default/js/menu.js"></script>

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
            <ul>
                <?php $counter1=-1; if( isset($pages) && is_array($pages) && sizeof($pages) ) foreach( $pages as $key1 => $value1 ){ $counter1++; ?>
                    <li><a href="index.php?page=<?php echo $value1;?>"><?php echo name($value1); ?></a></li>
                <?php } ?>
            </ul>
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
                <h1 class="text-box-head"><?php echo $message;?></h1>
                <p class="text-box-subhead">Plein de jolies images</p>
            </div>
        </div>

        <div class="pure-u-1-3">
            <div class="l-box">
                <div class="menu">
                    <ul>
                    <?php $counter1=-1; if( isset($categories) && is_array($categories) && sizeof($categories) ) foreach( $categories as $key1 => $value1 ){ $counter1++; ?>
                        <li><a href="index.php?dir=<?php echo $value1;?>"><?php echo name($value1); ?></a></li>
                        <?php if( is_sub_dir($value1)==1 ){ ?>
                            <?php $first_dir=$this->var['first_dir']=$value1;?>
                            <ul>
                            <?php $counter2=-1; if( isset($categories2) && is_array($categories2) && sizeof($categories2) ) foreach( $categories2 as $key2 => $value2 ){ $counter2++; ?>
                                <?php if( $first_dir==dir_name($value2) ){ ?><li><a href="index.php<?php echo $value2;?>"><?php echo name($value2); ?></a></li><?php } ?>
                            <?php } ?>
                            </ul>
                        <?php } ?>
                    <?php } ?>
                    </ul>
                </div>
            </div>
        </div>
        <div class="pure-u-2-3">
            <div class="l-box">
                <div class="l-centered">
                <!--&lt;?php if(comment_exist()==1) {
                    echo "<blockquote>";
                        show_comment();
                    echo "</blockquote>";
                } elseif(comment_exist()==2) { create_comment(); }?&gt; 
                <?php echo show_body();; ?>-->
                    
                <?php if( isset($picture) AND $picture==1 ){ ?>
                    Coucou les photos
                <?php } ?>
                </div>
            </div>
        </div>
    </div>

    <div class="footer">
        <!--&lt;?php echo $footer_text; ?&gt;-->
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
