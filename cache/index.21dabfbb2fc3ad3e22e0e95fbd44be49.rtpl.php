<?php if(!class_exists('raintpl')){exit;}?><!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><!--&lt;?php echo $title; ?&gt;--></title>

<link rel="stylesheet" href="http://yui.yahooapis.com/pure/0.2.1/pure-min.css">

<link rel="stylesheet" href="resources/template/default/default.css">
    
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
                <?php if( comment_exist()==1 ){ ?>
                    <?php echo show_comment(); ?>
                    <?php if( logged()==1 ){ ?><a href="index.php?path=<?php echo $comment_path;?>&amp;comment=edit">[Edit]</a><?php } ?>
                <?php }elseif( comment_exist()==2 ){ ?>
                    <?php if( logged()==1 ){ ?><a href="index.php?path=<?php echo $comment_path;?>&amp;comment=add">[Create]</a><?php } ?>
                <?php } ?>
                <!-- MEDIA -->
                <?php if( isset($medias) ){ ?>  
                    <?php $counter1=-1; if( isset($medias) && is_array($medias) && sizeof($medias) ) foreach( $medias as $key1 => $value1 ){ $counter1++; ?>
                        <!-- pictures -->
                        <?php if( is_img($value1)==1 ){ ?><a href="index.php?path=<?php echo $value1;?>"><img src="<?php echo $value1;?>" /></a>
                            <!-- comment -->
                            <?php if( logged()==1 AND comment_img_exist($value1)==0 ){ ?><a href="index.php?path=<?php echo $value1;?>&amp;single_comment=add">[Create]</a>
                            <?php }elseif( comment_img_exist($value1)==1 ){ ?>
                                <?php echo show_img_comment($value1); ?>
                                <?php if( logged()==1 ){ ?><a href="index.php?path=<?php echo $value1;?>&amp;single_comment=edit">[Edit]</a><?php } ?>
                            <?php } ?>
                        <!-- video -->
                        <?php }elseif( is_vid($value1)==1 ){ ?><p><?php echo display_video($value1); ?></p>
                            <!-- comment -->            
                            <?php if( logged()==1 AND comment_img_exist($value1)==0 ){ ?><a href="index.php?path=<?php echo $value1;?>&amp;single_comment=add">[Create]</a>
                            <?php }elseif( comment_img_exist($value1)==1 ){ ?>
                                <?php echo show_img_comment($value1); ?>
                                <?php if( logged()==1 ){ ?><a href="index.php?path=<?php echo $value1;?>&amp;single_comment=edit">[Edit]</a><?php } ?>
                            <?php } ?>
                        <?php } ?>
                    <?php } ?>
                <!-- COMMENT CREATION -->
                <?php }elseif( isset($add_comment) AND logged()==1 ){ ?>
                    <?php echo create_comment($add_comment); ?>
                <!-- SINGLE IMAGE -->
                <?php }elseif( isset($one_pic) ){ ?>
                    <!-- picture -->
                    <img src="<?php echo $one_pic;?>" />
                    <?php if( logged()==1 AND comment_img_exist($one_pic)==0 ){ ?><a href="index.php?path=<?php echo $one_pic;?>&amp;single_comment=add">[Create]</a>
                    <!-- comment -->
                    <?php }elseif( comment_img_exist($one_pic)==1 ){ ?>
                        <?php echo show_img_comment($one_pic); ?>
                        <?php if( logged()==1 ){ ?><a href="index.php?path=<?php echo $one_pic;?>&amp;single_comment=edit">[Edit]</a><?php } ?>
                    <?php } ?>
                    <!-- exif data -->
                    <?php $counter1=-1; if( isset($exif) && is_array($exif) && sizeof($exif) ) foreach( $exif as $key1 => $value1 ){ $counter1++; ?>
                        <ul>
                        <li><?php echo $value1;?></li>
                        </ul>
                    <?php } ?>
                <!-- PAGE -->
                <?php }elseif( isset($page) ){ ?>
                    <?php echo display_page($page); ?>
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
