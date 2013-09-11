<?php if(!class_exists('raintpl')){exit;}?><!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?php echo $title;?></title>

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8/jquery.min.js"></script>
<link rel="stylesheet" href="http://yui.yahooapis.com/pure/0.2.1/pure-min.css">
<link rel="stylesheet" href="resources/template/default/default.css">
<script type="text/javascript" src="resources/template/default/js/menu.js">
    
<script src="http://use.typekit.net/ajf8ggy.js"></script>
<script>
    try { Typekit.load(); } catch (e) {}
</script>
<script type="text/javascript">
    $(window).load(function(){  
    //for each description div...  
    $('div.description').each(function(){  
        //...set the opacity to 0...  
        $(this).css('opacity', 0);  
        //..set width same as the image...  
        $(this).css('width', $(this).siblings('img').width());  
        //...get the parent (the wrapper) and set it's width same as the image width... '  
        $(this).parent().css('width', $(this).siblings('img').width());  
        //...set the display to block  
        $(this).css('display', 'block');  
    });  
  
    $('div.wrapper').hover(function(){  
        //when mouse hover over the wrapper div  
        //get it's children elements with class description '  
        //and show it using fadeTo  
        $(this).children('.description').stop().fadeTo(500, 0.7);  
    },function(){  
        //when mouse out of the wrapper div  
        //use fadeTo to hide the div  
        $(this).children('.description').stop().fadeTo(500, 0);  
    });  
  
});     
</script>
    
<script type="text/javascript">
$(document).ready( function () {
    // On cache les sous-menus :
    $(".navigation ul.subMenu").hide();
    // On sélectionne tous les items de liste portant la classe "toggleSubMenu"
    // et on remplace l'élément span qu'ils contiennent par un lien :
    $(".navigation li.toggleSubMenu span").each( function () {
        // On stocke le contenu du span :
        var TexteSpan = $(this).text();
        $(this).replaceWith('<a href="" title="Afficher le sous-menu">' + TexteSpan + '<\/a>') ;
    } ) ;
    // On modifie l'évènement "click" sur les liens dans les items de liste
    // qui portent la classe "toggleSubMenu" :
    $(".navigation li.toggleSubMenu > a").click( function () {
        // Si le sous-menu était déjà ouvert, on le referme :
        if ($(this).next("ul.subMenu:visible").length != 0) {
            $(this).next("ul.subMenu").slideUp("normal");
        }
        // Si le sous-menu est caché, on ferme les autres et on l'affiche :
        else {
            $(".navigation ul.subMenu").slideUp("normal");
            $(this).next("ul.subMenu").slideDown("normal");
        }
        // On empêche le navigateur de suivre le lien :
        return false;
    });    
} ) ;
</script>    

</head>
<body>

<div>
    <div class="header">
        <div class="pure-menu pure-menu-open pure-menu-horizontal">
            <a class="pure-menu-heading" href="<?php echo $site_url;?>">Photo Gallery</a>
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
                <h1 class="text-box-head"><?php echo $title;?></h1>
                <p class="text-box-subhead">Propulsé par Graphist Gallery</p>
            </div>
        </div>

        <div class="pure-u-1-3">
            <div class="l-box">
                <div class="menu">
                    <p class="header-menu">Menu</p>
                    <ul class="navigation">
                    <?php $counter1=-1; if( isset($categories) && is_array($categories) && sizeof($categories) ) foreach( $categories as $key1 => $value1 ){ $counter1++; ?>
                        <?php if( is_sub_dir($value1)!=1 ){ ?><li><a href="index.php?dir=<?php echo $value1;?>"><?php echo name($value1); ?></a>
                        <?php }else{ ?><li class="toggleSubMenu"><span><?php echo name($value1); ?></span>
                            <?php $first_dir=$this->var['first_dir']=$value1;?>
                            <ul class="subMenu">
                            <?php $counter2=-1; if( isset($categories2) && is_array($categories2) && sizeof($categories2) ) foreach( $categories2 as $key2 => $value2 ){ $counter2++; ?>
                                <?php if( $first_dir==dir_name($value2) ){ ?><li><a href="index.php<?php echo $value2;?>"><?php echo name($value2); ?></a></li><?php } ?>
                            <?php } ?>
                            </ul>
                        <?php } ?>
                        </li>
                    <?php } ?>
                    </ul>
                </div>
            </div>
        </div>
        <div class="pure-u-2-3">
            <div class="l-box">
                <div class="l-centered">
                <?php if( comment_exist()==1 ){ ?>
                    <blockquote class="content-quote"><?php echo show_comment(); ?>
                    <?php if( logged()==1 ){ ?><a href="index.php?path=<?php echo $comment_path;?>&amp;comment=edit" class="pure-button">Edit</a><?php } ?></blockquote>
                <?php }elseif( comment_exist()==2 ){ ?>
                    <?php if( logged()==1 ){ ?><a href="index.php?path=<?php echo $comment_path;?>&amp;comment=add" class="pure-button">Create</a><?php } ?>
                <?php } ?>
                <!-- MEDIA -->
                <?php if( isset($medias) ){ ?>  
        
                    <?php $counter1=-1; if( isset($medias) && is_array($medias) && sizeof($medias) ) foreach( $medias as $key1 => $value1 ){ $counter1++; ?>
                        <div class="wrapper">
                        <!-- pictures -->
                        <?php if( is_img($value1)==1 ){ ?><a href="index.php?path=<?php echo $value1;?>"><img src="<?php echo $value1;?>" /></a>
                            <!-- comment -->
                            <div class='description'> 
                            <?php if( logged()==1 AND comment_img_exist($value1)==0 ){ ?><a href="index.php?path=<?php echo $value1;?>&amp;single_comment=add" class="pure-button ">Create</a>
                            <?php }elseif( comment_img_exist($value1)==1 ){ ?>
                                <div class='description_content'><?php echo show_img_comment($value1); ?>
                                <?php if( logged()==1 ){ ?><a href="index.php?path=<?php echo $value1;?>&amp;single_comment=edit" class="pure-button pure-button-primary">Edit</a><?php } ?>
                                </div>
                            <?php } ?>
                            </div>
                        <!-- video -->
                        <?php }elseif( is_vid($value1)==1 ){ ?><p><?php echo display_video($value1); ?></p>
                            <!-- comment -->            
                            <?php if( logged()==1 AND comment_img_exist($value1)==0 ){ ?><a href="index.php?path=<?php echo $value1;?>&amp;single_comment=add" class="pure-button pure-button-primary">Create</a>
                            <?php }elseif( comment_img_exist($value1)==1 ){ ?>
                                <?php echo show_img_comment($value1); ?>
                                <?php if( logged()==1 ){ ?><a href="index.php?path=<?php echo $value1;?>&amp;single_comment=edit" class="pure-button">Edit</a><?php } ?>
                            <?php } ?>
                        <?php } ?>
                        </div>
                    <?php } ?>
                <!-- COMMENT CREATION -->
                <?php }elseif( isset($add_comment) AND logged()==1 ){ ?>
                    <?php echo create_comment($add_comment); ?>
                <!-- SINGLE IMAGE -->
                <?php }elseif( isset($one_pic) ){ ?>
                    <!-- picture -->
                    <img src="<?php echo $one_pic;?>" />
                    <?php if( logged()==1 AND comment_img_exist($one_pic)==0 ){ ?><a href="index.php?path=<?php echo $one_pic;?>&amp;single_comment=add" class="pure-button">Create</a>
                    <!-- comment -->
                    <?php }elseif( comment_img_exist($one_pic)==1 ){ ?>
                        <?php echo show_img_comment($one_pic); ?>
                        <?php if( logged()==1 ){ ?><a href="index.php?path=<?php echo $one_pic;?>&amp;single_comment=edit" class="pure-button">Edit</a><?php } ?>
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
        <?php echo $footer_text;?>
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
