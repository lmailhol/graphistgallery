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
    <h2>Configuration Panel</h2>
</div>


<div class="content">
    
    <h2 class="content-subhead">Configuration</h2>    
        
   <form class="pure-form pure-form-aligned">
    <fieldset>        
        <div class="pure-control-group">
            <label for="name">Nom du site</label>
            <input id="name" type="text" placeholder="Nom du site">
        </div>
        
        <div class="pure-control-group">
            <label for="name">Url du site</label>
            <input id="name" type="text" placeholder="Url">
        </div>
        
        <div class="pure-control-group">
            <label for="state">Page d'accueil</label>
            <select id="state">
                <option>Page 1</option>
                <option>Page 2</option>
            </select>
        </div>
        
        <div class="pure-control-group">
            <label for="name">Nom de l'utilisateur</label>
            <input id="name" type="text" placeholder="Utilisateur">
        </div>
        
        <div class="pure-control-group">
            <label for="name">Mot de passe</label>
            <input id="name" type="password" placeholder="Mot de passe">
        </div>

        <div class="pure-controls">
            <button type="submit" class="pure-button pure-button-primary">Submit</button>
        </div>
    </fieldset>
</form>
    
    <h2 class="content-subhead">Configuration avancée</h2>
    
    <?php
        echo $admin_config_site;
        echo "<p><a href=\"admin_pages.php?fichier=../config.php&amp;action=modif\">".$info_modif_config."</a></p>";
    ?>  

</div>
</div>

<?php
    
include("include/footer.php");


} else {
    admin_connection();
}
?>
