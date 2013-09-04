<?php
session_start();

$menu = "config";

/*
 * Copyright (C) 2010 Mailhol Luca
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 * 
 * You should have received a copy of the GNU General Public License along
 * with this program; if not, write to the Free Software Foundation, Inc.,
 * 51 Franklin Street, Fifth Floor, Boston, MA 02110-1301 USA.
 */

require("../config.php");
require("functions.php");
require("../".$rep_lang.$lang.".php");
require("../default_config.php");

if(isset($_SESSION['name']) AND isset($_SESSION['psw'])) {

include("include/header.php"); ?>
    
<div class="pure-u-1" id="main">
<div class="header">
    <h1>Graphist Gallery</h1>
    <h2>Configuration Panel</h2>
</div>


<div class="content">

    <h2 class="content-subhead">Configuration</h2>    
<div class="pure-g-r">
<div class="pure-u-3-5">
<?php
if(isset($_POST['name']) AND isset($_POST['url']) AND isset($_POST['index']) AND isset($_POST['lang']) AND isset($_POST['footer']) AND isset($_POST['user']) AND isset($_POST['password']) AND isset($_POST['template'])) {
    write_config($_POST['name'],$_POST['url'],$_POST['index'],$_POST['lang'],$_POST['footer'],$_POST['user'],$_POST['password'],$_POST['template']);
    echo $modif_config_done;
    echo "<br/><a href=\"admin_site_configuration.php\">".$retour."</a>";
} else {
    
?>
   <form action="admin_site_configuration.php" method="post" class="pure-form pure-form-aligned">
    <fieldset>        
        <div class="pure-control-group">
            <label for="name"><?php echo $site_name; ?></label>
            <input id="name" name="name" type="text" value="<?php echo $title; ?>" placeholder="Name">
        </div>
        
        <div class="pure-control-group">
            <label for="url"><?php echo $site_url; ?></label>
            <input id="url" name="url" type="text" value="<?php echo $site; ?>" placeholder="Url">
        </div>
        
        <div class="pure-control-group">
            <label for="index"><?php echo $site_index; ?></label>
            <select name="index" id="index">
                <?php show_form_list_pages(); ?>
            </select>
        </div>
        
        <div class="pure-control-group">
            <label for="template"><?php echo $site_template; ?></label>
            <select id="template" name="template">
                <?php show_themes(); ?>
            </select>
        </div>
        
        <div class="pure-control-group">
            <label for="footer"><?php echo $site_footer; ?></label>
            <input id="footer" name="footer" type="text" value="<?php echo htmlspecialchars($footer_text); ?>" placeholder="Footer">
        </div>
        
        <div class="pure-control-group">
            <label for="user"><?php echo $site_user; ?></label>
            <input id="user" name="user" type="text" value="<?php echo $user; ?>" placeholder="User">
        </div>
        
        <div class="pure-control-group">
            <label for="password"><?php echo $site_password; ?></label>
            <input id="password" name="password" type="password" value="<?php echo $psw; ?>" placeholder="Password">
        </div>
    </fieldset>
    <fieldset>
       <div class="pure-control-group">
            <label for="lang"><?php echo $site_lang; ?></label>
            <select name="lang" id="lang">
                <?php show_languages(); ?>
            </select>
        </div> 
       <div class="pure-controls">
            <button type="submit" class="pure-button pure-button-primary"><?php echo $submit; ?></button>
        </div>
    </fieldset>
</form>
<?php } ?>
</div>
<div class="pure-u-2-5"><?php echo $config_text; ?></div>
</div>
    
    <h2 class="content-subhead">Configuration avancée</h2>
    
    <?php
        echo $admin_config_site;
        echo "<p><a href=\"admin_pages.php?fichier=../config.php&amp;action=modif&amp;config=1\">".$info_modif_config."</a></p>";
    ?>  

</div>
</div>

<?php
    
include("include/footer.php");


} else {
    admin_connection();
}
?>
