<!doctype html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <?php show_head(); ?>
    <?php require("config_bleu.php"); ?>
    <?php if($js_menu==1){echo '<script type="text/javascript" src="'.$path_style.'js/menu.js"></script>';}?>

    <title><?php echo $title; ?></title>
</head>
<body>
	<div id="wrap">
        
		<div id="header">
            <img src="<?php if(isset($logo)) { echo $path_style."img/".$logo; } ?>" alt="<?php echo $title; ?>"/>
		</div>
        
        <div id="right">
            <?php if(comment_exist()==1) {
            echo "<div id=\"comment\">";
                show_comment();
            echo "</div>";
            }?>

		<?php show_body(); ?> 
        </div>
        
		<div id="left">
            <div class="dot">&nbsp;</div>
				<?php show_pages("", ""); ?>
			<div class="dot">&nbsp;</div>
                <?php
                    show_categories("menujs","toggleSubMenu","","subMenu","", 1);
                ?>
            <!-- <div class="dot">&nbsp;</div> -->
                <?php
                    //show_categories("menujs","toggleSubMenu","","subMenu","", 2);
                ?>
        </div>
                    
        <div id="footer">
				<?php if(isset($footer_text)) { echo $footer_text; } ?>
		</div>   
    

</div>

</body>
</html>
