<?php
session_start();

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
    <h2>Administration Panel</h2>
</div>


<div class="content">

    <p>&nbsp;</p>   
    
    <aside>
        <p>
            <?php echo $admin_welcome; ?>
        </p>
    </aside>
    
    <h2 class="content-subhead">Administration</h2>
    
    <div class="l-centered">
        <a class="pure-button" href="admin_pages.php">        
            <i class="icon-file"></i>
            <?php echo $pages_admin_button; ?>
        </a>
        <a class="pure-button" href="admin_site_configuration.php">        
            <i class="icon-cog"></i>
            <?php echo $config_admin_button; ?>
        </a>
        <a class="pure-button" href="admin_theme_configuration.php">        
            <i class="icon-th-large"></i>
            <?php echo $template_admin_button; ?>
        </a>
    </div>
    

    <h2 class="content-subhead"><?php echo $admin_features; ?></h2>

    <ul class="content-spaced">
        <?php echo $admin_features2; ?>
    </ul>

    <div class="pure-g-r">
    <div class="pure-u-1-2">
        <div class="l-box">
            <h3><?php echo $admin_version; ?></h3>
            <p>
                <?php echo $admin_version2; ?>
            </p>
        </div>
    </div>

    <div class="pure-u-1-2">
        <div class="l-box">
            <div class="l-centered">
                <img src="../img/logo_gg.jpg" alt="Logo Graphist Gallery"/>
            </div>
            <div class="l-centered">
                <form class="pure-form" action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
<fieldset>
<input type="hidden" name="cmd" value="_s-xclick">
<input type="hidden" name="hosted_button_id" value="X5CZ9VGTMWV3L">
<a class="pure-button" href="https://github.com/Radek411/graphistgallery">Fork me</a>
<button type="submit" class="pure-button">Donation</button>
</fieldset>
</form>
            </div>
        </div>
    </div>

</div>
</div>

<?php
    
include("include/footer.php");


} else {
    admin_connection();
}
?>
