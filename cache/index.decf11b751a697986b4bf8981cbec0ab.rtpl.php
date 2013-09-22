<?php if(!class_exists('raintpl')){exit;}?><!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?php echo $title;?></title>

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8/jquery.min.js"></script>
<link rel="stylesheet" href="http://yui.yahooapis.com/pure/0.3.0/pure-min.css">
<link rel="stylesheet" href="resources/template/default1/default.css">
    
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






<div class="pure-g-r" id="layout">
    <div class="sidebar pure-u">
        <header class="header">
            <hgroup>
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
            </hgroup>
        </header>
    </div>

    <div class="pure-u-1">
        <div class="content">
            <!-- A wrapper for all the blog posts -->
            <div class="posts">
                <h1 class="content-subhead">Pinned Post</h1>

                <!-- A single blog post -->
                <section class="post">
                    <header class="post-header">
                        <img class="post-avatar"
                             alt="Tilo Mitra's avatar" src="/img/common/tilo-avatar.png"
                             height="48" width="48">

                        <h2 class="post-title">Introducing Pure</h2>

                        <p class="post-meta">
                            By <a href="#" class="post-author">Tilo Mitra</a> under <a class="post-category post-category-design" href="#">CSS</a> <a class="post-category post-category-pure" href="#">Pure</a>
                        </p>
                    </header>

                    <div class="post-description">
                        <p>
                            Yesterday at CSSConf, we launched Pure – a new CSS library. Phew! Here are the <a href="https://speakerdeck.com/tilomitra/pure-bliss">slides from the presentation</a>. Although it looks pretty minimalist, we’ve been working on Pure for several months. After many iterations, we have released Pure as a set of small, responsive, CSS modules that you can use in every web project.
                        </p>
                    </div>
                </section>
            </div>

            <div class="posts">
                <h1 class="content-subhead">Recent Posts</h1>

                <section class="post">
                    <header class="post-header">
                        <img class="post-avatar"
                             alt="Eric Ferraiuolo's avatar" src="/img/common/ericf-avatar.png"
                             height="48" width="48">

                        <h2 class="post-title">Everything You Need to Know About Grunt</h2>

                        <p class="post-meta">
                            By <a class="post-author" href="#">Eric Ferraiuolo</a> under <a class="post-category post-category-js" href="#">JavaScript</a>
                        </p>
                    </header>

                    <div class="post-description">
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.
                        </p>
                    </div>
                </section>

                <section class="post">
                    <header class="post-header">
                        <img class="post-avatar" alt="Reid Burke's avatar"
                             src="/img/common/reid-avatar.png"
                             height="48" width="48">

                        <h2 class="post-title">Photos from CSSConf and JSConf</h2>

                        <p class="post-meta">
                            By <a class="post-author" href="#">Reid Burke</a> under <a class="post-category" href="#">Uncategorized</a>
                        </p>
                    </header>

                    <div class="post-description">
                        <div class="post-images pure-g-r">
                            <div class="pure-u-1-2">
                                <a href="http://www.flickr.com/photos/uberlife/8915936174/">
                                    <img alt="Photo of someone working poolside at a resort"
                                         src="http://farm8.staticflickr.com/7448/8915936174_8d54ec76c6.jpg">
                                </a>

                                <div class="post-image-meta">
                                    <h3>CSSConf Photos</h3>
                                </div>
                            </div>

                            <div class="pure-u-1-2">
                                <a href="http://www.flickr.com/photos/uberlife/8907351301/">
                                    <img alt="Photo of the sunset on the beach"
                                         src="http://farm8.staticflickr.com/7382/8907351301_bd7460cffb.jpg">
                                </a>

                                <div class="post-image-meta">
                                    <h3>JSConf Photos</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <section class="post">
                    <header class="post-header">
                        <img class="post-avatar"
                             alt="Andrew Wooldridge's avatar" src="/img/common/andrew-avatar.png"
                             height="48" width="48">

                        <h2 class="post-title">YUI 3.10.2 Released</h2>

                        <p class="post-meta">
                            By <a class="post-author" href="#">Andrew Wooldridge</a> under <a class="post-category post-category-yui" href="#">YUI</a>
                        </p>
                    </header>

                    <div class="post-description">
                        <p>
                            We are happy to announce the release of YUI 3.10.2! You can find it now on the Yahoo! CDN, download it directly, or pull it in via npm. We’ve also updated the YUI Library website with the latest documentation.
                        </p>
                    </div>
                </section>
            </div>

            <footer class="footer">
                <div class="pure-menu pure-menu-horizontal pure-menu-open">
                    <ul>
                        <li><a href="http://purecss.io/">About</a></li>
                        <li><a href="http://twitter.com/yuilibrary/">Twitter</a></li>
                        <li><a href="http://github.com/yui/pure/">Github</a></li>
                    </ul>
                </div>
            </footer>
        </div>
    </div>
</div>

<script src="http://yui.yahooapis.com/3.12.0/build/yui/yui-min.js"></script>
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
