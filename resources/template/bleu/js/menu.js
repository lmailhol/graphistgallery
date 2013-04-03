/*
 * Copyright (C) 2010 D. Thomas -- http://alsacreations.com/
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

$(document).ready( function () { 
    $(".menujs ul.subMenu").hide(); 
     $(".menujs li.toggleSubMenu span").each( function () { 
        var TexteSpan = $(this).text(); 
        $(this).replaceWith('<a href="" title="Afficher le sous-menu">' + TexteSpan + ' (↓)<\/a>') ; 
    } ) ; 
     $(".menujs li.toggleSubMenu > a").click( function () { 
        if ($(this).next("ul.subMenu:visible").length != 0) { 
            $(this).next("ul.subMenu").slideUp("normal", function () { $(this).parent().removeClass("open") } ); 
        } 
        else { 
            $(".menujs ul.subMenu").slideUp("normal", function () { $(this).parent().removeClass("open") }); 
            $(this).next("ul.subMenu").slideDown("normal", function () { $(this).parent().addClass("open") } ); 
        } 
        return false; 
    }); 
 
} ) ; 
