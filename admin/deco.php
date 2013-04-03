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
require("../".$rep_lang.$lang.".php");

echo "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Strict//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd\">";
echo "<html xmlns=\"http://www.w3.org/1999/xhtml\" xml:lang=\"fr\" lang=\"fr\">";
echo "<head>";
echo "<meta http-equiv=\"Content-Type\" content=\"text/html\" charset=\"UTF-8\" />";
echo "<link rel=\"StyleSheet\" href=\"admin_template.css\" type=\"text/css\" media=\"all\" />";
echo "<title>Graphist Gallery - Auth</title>";
echo "</head><body><div class=\"box\">";
if(isset($_SESSION['name']) AND isset($_SESSION['psw'])) {
    session_destroy();
    echo $deco_done."<br/>";
    echo "<a href=\"index.php\">".$recharger."</a>";
} else {
    echo $erreur_deco."<br/>";
    echo "<a href=\"index.php\">".$recharger."</a>";
}
echo "</div></body></html>";
?>
