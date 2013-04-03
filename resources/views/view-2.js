/*
 * Copyright (C) 2010 D.C. Benjamin -- http://alsacreations.com/
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

jQuery(function($){ 
 
  var settings = { 
    thumbListId: "thumbs", 
    imgViewerId: "viewer", 
    activeClass: "active", 
    activeTitle: "Photo en cours de visualisation", 
    loaderTitle: "Chargement en cours", 
    loaderImage: "../../img/loader.gif" 
  }; 
 
  var thumbLinks = $("#"+settings.thumbListId).find("a"), 
    firstThumbLink = thumbLinks.eq(0), 
    highlight = function(elt){ 
      thumbLinks.removeClass(settings.activeClass).removeAttr("title"); 
      elt.addClass(settings.activeClass).attr("title",settings.activeTitle); 
    }, 
    loader = $(document.createElement("img")).attr({ 
      alt: settings.loaderTitle, 
      title: settings.loaderTitle, 
      src: settings.loaderImage 
    }); 
 
  highlight(firstThumbLink); 
 
  $("#"+settings.thumbListId).after( 
    $(document.createElement("p")) 
      .attr("id",settings.imgViewerId) 
      .append( 
        $(document.createElement("img")).attr({ 
          alt: "", 
          src: firstThumbLink.attr("href") 
        }) 
      ) 
  ); 
 
  var imgViewer = $("#"+settings.imgViewerId), 
    bigPic = imgViewer.children("img"); 
 
  thumbLinks 
    .click(function(e){ 
      e.preventDefault(); 
      var $this = $(this), 
        target = $this.attr("href"); 
      if (bigPic.attr("src") == target) return; 
      highlight($this); 
      imgViewer.html(loader); 
      bigPic 
        .load(function(){ 
          imgViewer.html($(this).fadeIn(250)); 
        }) 
        .attr("src",target); 
    }); 
 
});
