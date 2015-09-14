<?php if(!class_exists('raintpl')){exit;}?><!DOCTYPE html>
<html lang="fr">
<head>

  <!-- Basic Page Needs
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->
  <meta charset="utf-8">
  <title><?php echo $title;?></title>
  <meta name="description" content="">
  <meta name="author" content="">

  <!-- Mobile Specific Metas
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- FONT
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->
  <link href="//fonts.googleapis.com/css?family=Raleway:400,300,600" rel="stylesheet" type="text/css">  
  <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
    
  <!-- CSS
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->
  <link rel="stylesheet" href="<?php echo $path_style;?>/css/normalize.css">
  <link rel="stylesheet" href="<?php echo $path_style;?>/css/skeleton.css">
  <link rel="stylesheet" href="<?php echo $path_style;?>/css/style.css">
    
  <!-- JS
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
  <script src="<?php echo $path_style;?>/js/responsiveslides.js"></script>

  <!-- Favicon
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->
  <link rel="icon" type="image/png" href="<?php echo $path_style;?>/images/favicon.png">
    
  <!-- Script
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->

  <script>
    $(function () {

      // Slideshow index
      $(".slides_index").responsiveSlides({
        auto: true,
        pager: false,
        nav: false,
        speed: 250,
      });
        
      $(".slides_images").responsiveSlides({
        auto: false,
        pager: false,
        prevText: "Précédent",
        nextText: "Suivant",
        nav: true,
        speed: 500,
        maxwidth: 800,
        namespace: "images_slider"
      });

    });
    </script>
    
<script type="text/javascript">
  $(document).ready(function($) {
    $('#accordion').find('.toggler').click(function(){

      //Expand or collapse this panel
      $(this).next().slideToggle('500');

      //Hide the other panels
      $(".toggle").not($(this).next()).slideUp('500');

    });
  });
</script>

    
</head>
<body>
    
  <!-- Primary Page Layout
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->
  <div class="container">      

        <div class="row">
            <div class="two columns">
                <div class="logo">
                    <a href="index.php"><img src="<?php echo $path_style;?>/images/logo.png" /></a>
                </div>
                <div class="menu">
                    <ul>
                    <?php $counter1=-1; if( isset($pages) && is_array($pages) && sizeof($pages) ) foreach( $pages as $key1 => $value1 ){ $counter1++; ?>

                        <li><a href="index.php?page=<?php echo $value1;?>"><?php echo name($value1); ?></a></li>
                    <?php } ?>

                    </ul>
                    
                    <ul id="accordion">
                    <?php $counter1=-1; if( isset($categories_1) && is_array($categories_1) && sizeof($categories_1) ) foreach( $categories_1 as $key1 => $value1 ){ $counter1++; ?>

                        <?php if( is_sub_dir($value1,1)!=1 ){ ?><li><a href="index.php?path=content/<?php echo $value1;?>"><?php echo name($value1); ?></a>
                        <?php }else{ ?><li><a class="toggler" style="cursor:pointer;" href="#"><?php echo name($value1); ?></a>
                        <?php $first_dir=$this->var['first_dir']=$value1;?>

                            <ul class="toggle" style="display:none;">
                            <?php $counter2=-1; if( isset($categories2_1) && is_array($categories2_1) && sizeof($categories2_1) ) foreach( $categories2_1 as $key2 => $value2 ){ $counter2++; ?>

                                <?php if( $first_dir==dir_name($value2) ){ ?><li><a href="index.php?path=content/<?php echo $value2;?>"><?php echo name($value2); ?></a></li><?php } ?>

                            <?php } ?>

                            </ul>    
                        <?php } ?>

                        </li>
                    <?php } ?>

                    </ul>
                </div>
            </div>
            
            <!-- Medias
            –––––––––––––––––––––––––––––––––––––––––––––––––– -->
            
            <?php if( isset($medias) ){ ?>

            
            <div class="ten columns">            
                <div class="images">
                    <ul class="slides_images">
                        <?php $counter1=-1; if( isset($medias) && is_array($medias) && sizeof($medias) ) foreach( $medias as $key1 => $value1 ){ $counter1++; ?>

                            <?php if( is_img($value1)==1 ){ ?>

                                <li><img src="<?php echo $value1;?>" alt="" />
                                <?php if( comment_img_exist($value1)==1 ){ ?>

                                    <div class="caption"><?php echo show_img_comment($value1); ?></div>
                                <?php } ?>

                                </li>
                            <?php } ?>

                        <?php } ?>

                    </ul>
                        <?php $counter1=-1; if( isset($medias) && is_array($medias) && sizeof($medias) ) foreach( $medias as $key1 => $value1 ){ $counter1++; ?>

                            <?php if( is_vid($value1)==1 ){ ?>

                                <?php echo display_video($value1); ?>

                            <?php } ?>

                        <?php } ?>

                     <div class="comment">
                        <div class="one-half column">
                            <?php if( comment_exist()==1 ){ ?>

                                <?php echo show_comment(); ?>

                            <?php } ?>

                        </div>
                        <div class="one-half column">
                            <h3><?php echo show_folder_name(); ?><a class="retour" href="javascript:history.go(-1)">(retour)</a></h3>     
                        </div>
                    </div>
                </div>       
            </div>

             <!-- Page
            –––––––––––––––––––––––––––––––––––––––––––––––––– -->
            
            <?php }elseif( isset($page) ){ ?>

                <div class="ten columns">
                    <?php if( $page==$index ){ ?>                        
                        <div class="index">
                            <?php echo display_page($page); ?>

                        </div>
                    <?php }else{ ?>

                        <div class="texte">
                            <div class="one-half column">
                                <?php echo display_page($page); ?>

                            </div>
                        </div>
                    <?php } ?>

                </div>
            <?php } ?>

            
            
            <div class="twelve columns">
                <div class="footer">
                    <p><?php echo $footer_text;?></p>
                </div>
            </div>
        </div>
</div>


<!-- End Document
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->
</body>
</html>