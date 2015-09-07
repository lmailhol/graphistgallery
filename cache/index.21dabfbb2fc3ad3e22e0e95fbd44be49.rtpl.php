<?php if(!class_exists('raintpl')){exit;}?><!DOCTYPE html>
<!--[if lt IE 7 ]><html class="ie ie6" lang="fr"> <![endif]-->
<!--[if IE 7 ]><html class="ie ie7" lang="fr"> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" lang="fr"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html lang="fr"> <!--<![endif]-->
<head>

	<!-- Basic Page Needs
  ================================================== -->
	<meta charset="utf-8">
	<title><?php echo $title;?></title>
	<meta name="description" content="">
	<meta name="author" content="">

	<!-- Mobile Specific Metas
  ================================================== -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

	<!-- CSS
  ================================================== -->
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8/jquery.min.js"></script>
	<link rel="stylesheet" href="<?php echo $path_style;?>/stylesheets/base.css">
	<link rel="stylesheet" href="<?php echo $path_style;?>/stylesheets/skeleton.css">
	<link rel="stylesheet" href="<?php echo $path_style;?>/stylesheets/layout.css">

	<!--[if lt IE 9]>
		<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->

	<!-- Favicons
	================================================== -->
    <link rel="icon" type="image/png" href="<?php echo $path_style;?>/images/favicon.png" />
    
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
    
    <!-- http://www.designchemical.com/blog/index.php/jquery/jquery-simple-vertical-accordion-menu/ -->
    <script type="text/javascript">
        $(document).ready(function () {
            $('.menujs > li > a').click(function(){
            if ($(this).attr('class') != 'active'){
                $('.menujs li ul').slideUp();
                $(this).next().slideToggle();
                $('.menujs li a').removeClass('active');
                $(this).addClass('active');
            }
            });
        });
</script>
</head>
<body>
    
	<!-- Primary Page Layout
	================================================== -->

	<div class="container">
		<div class="sixteen columns">
			<h1 class="remove-bottom" style="margin-top: 40px"><?php echo $title;?></h1>
			<hr />
		</div>
		<div class="three columns">
            <ul class="menujs">
                <?php $counter1=-1; if( isset($pages) && is_array($pages) && sizeof($pages) ) foreach( $pages as $key1 => $value1 ){ $counter1++; ?>

                    <li class="toggleSubMenu"><a href="index.php?page=<?php echo $value1;?>"><?php echo name($value1); ?></a></li>
                <?php } ?>

            </ul>
            
                <ul class="menujs">
                <?php $counter1=-1; if( isset($categories_1) && is_array($categories_1) && sizeof($categories_1) ) foreach( $categories_1 as $key1 => $value1 ){ $counter1++; ?>

                    <?php if( is_sub_dir($value1,1)!=1 ){ ?><li><a href="index.php?path=content/<?php echo $value1;?>"><?php echo name($value1); ?></a>
                    <?php }else{ ?><li><a href="#"><?php echo name($value1); ?></a>
                        <?php $first_dir=$this->var['first_dir']=$value1;?>

                        <ul>
                        <?php $counter2=-1; if( isset($categories2_1) && is_array($categories2_1) && sizeof($categories2_1) ) foreach( $categories2_1 as $key2 => $value2 ){ $counter2++; ?>

                            <?php if( $first_dir==dir_name($value2) ){ ?><li><a href="index.php?path=content/<?php echo $value2;?>"><?php echo name($value2); ?></a></li><?php } ?>

                        <?php } ?>

                        </ul>
                    <?php } ?>

                    </li>
                <?php } ?>

                </ul>
        </div>
		<div class="thirteen columns">
			    <div class="twelve columns">
                <!-- MEDIA -->
                <?php if( isset($medias) ){ ?>

                    
                    <?php if( comment_exist()==1 ){ ?>

                    <blockquote class="content-quote"><?php echo show_comment(); ?></blockquote>
                    <?php } ?>

                    
                    <?php $counter1=-1; if( isset($medias) && is_array($medias) && sizeof($medias) ) foreach( $medias as $key1 => $value1 ){ $counter1++; ?>

                        <div class="wrapper">
                        <!-- pictures -->
                        <?php if( is_img($value1)==1 ){ ?><a href="index.php?path=<?php echo $value1;?>&amp;single"><img src="<?php echo $value1;?>" class="scale-with-grid" /></a>
                            <!-- comment -->
                            <div class='description'> 
                            <?php if( comment_img_exist($value1)==1 ){ ?>

                                <div class='description_content'><?php echo show_img_comment($value1); ?></div>
                            <?php } ?>

                            </div>
                        <!-- video -->
                        <?php }elseif( is_vid($value1)==1 ){ ?>

                            <p><?php echo display_video($value1); ?></p>
                            <!-- comment -->            
                            <?php if( comment_img_exist($value1)==1 ){ ?>

                                <?php echo show_img_comment($value1); ?>

                            <?php } ?>

                        <?php } ?>

                        </div>
                    <?php } ?>

                <!-- SINGLE IMAGE -->
                <?php }elseif( isset($one_pic) ){ ?>

                    <!-- picture -->
                    <img src="<?php echo $one_pic;?>" class="scale-with-grid" />
                    <!-- comment -->
                    <?php if( comment_img_exist($one_pic)==1 ){ ?>

                        <?php echo show_img_comment($one_pic); ?>

                    <?php } ?>

                    <!-- exif data -->
                    <?php if( $exif!=0 ){ ?>

                        <ul>
                        <li><?php echo $exif["date"];?></li>
                        <li>Modèle : <?php echo $exif["model"];?></li>
                        <li><?php echo $exif["aperture"];?> - <?php echo $exif["exposure"];?> - ISO <?php echo $exif["iso"];?></li>
                        </ul>
                    <?php } ?>

                <!-- PAGE -->
                <?php }elseif( isset($page) ){ ?>

                    <?php echo display_page($page); ?>

                <?php } ?>

            </div>
		</div>
		<div class="sixteen columns">
            <hr />
            <?php echo $footer_text;?>

        </div>

	</div><!-- container -->


<!-- End Document
================================================== -->
</body>
</html>
