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
            Vous venez d'installer Graphist Gallery, merci beaucoup !
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
    

    <h2 class="content-subhead">Features</h2>

    <ul class="content-spaced">
        <li>Adds configurable media queries for different screen widths (Desktops, Landscape Tablets, Portrait Tablets, Phones)</li>
        <li>Collapses elements to 100% if smaller than a certain width (767px by default)</li>
        <li>Adjusts images to fit on smaller screens</li>
        <li>Works with as many columns as you want (or as few)</li>
        <li>Supports configurable prefixes</li>
    </ul>

    <div class="pure-g-r">
    <div class="pure-u-1-2">
        <div class="l-box">
            <h3>Fast</h3>
            <p>
                YUI's lightweight core and modular architecture make it scalable, fast, and robust. Built by frontend engineers at Yahoo!, YUI powers the most popular websites in the world.
            </p>
        </div>
    </div>

    <div class="pure-u-1-2">
        <div class="l-box">
            <h3>Complete</h3>
            <p>
                YUI's intuitive and well-documented API takes you from basic DOM handling to building performant and maintainable applications on desktop browsers, mobile devices, and servers.
            </p>
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
