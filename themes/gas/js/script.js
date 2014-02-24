/*!
 *
 *  Copyright (c) David Bushell | http://dbushell.com/
 *
 */

var currentNavigation = false,
	didScroll = false;
 
function toggleLeftNav() {
	console.log("Left nav toggle");
	if(currentNavigation!="left") {
//		$(".sidenav-right").hide();
		$(".sidenav-left").show();
		$(document.documentElement).removeClass("js-nav-right").addClass("js-nav-left");
		currentNavigation = "left";
	} else {
		$(document.documentElement).removeClass("js-nav-left");
		setTimeout(function() {
			$(".sidenav-left").hide();
		}, 800);	
		currentNavigation = false;
	}
}

function toggleRightNav() {
	console.log("Right nav toggle");
	if(currentNavigation!="right") {
//		$(".sidenav-left").hide();
		$(".sidenav-right").show();
		$(document.documentElement).removeClass("js-nav-left").addClass("js-nav-right");
		currentNavigation = "right";
	} else {
		$(document.documentElement).removeClass("js-nav-right");
		setTimeout(function() {
			$(".sidenav-right").hide();
		}, 800);
		currentNavigation = false;
	}
}

function reflowSections() {
	$('div.section').foundation('section','reflow').fadeIn();
}

setInterval(function() {
	if(didScroll) {
		didScroll=false;
		$('.fix-y').each(function() {
			dy = $(this).data("dy");
			//console.log($(this).css("top"));
			if($(this).hasClass('animate')) {
				$(this).stop(true).animate({'top': $(window).scrollTop() + dy},500,'easeOutQuad');
			}
			else {
				$(this).css({'top': $(window).scrollTop() + dy});
			}
		});
	}
},500);

$(document).ready(function() {	
	console.log("Document ready.");
	$(document.documentElement).addClass("js-ready");
	
//	$('.sidenav-right').hide();
//	$('.sidenav-left').hide();
		
	//ACTIONS
	$(".action").removeClass("round").addClass("button").addClass("radius");
	$(".js-ready #Form_FilterForm .action").hide();
	// $(".action").addClass("btn-primary");
	$(".message").addClass("alert-box");
	$(".message.bad").addClass("alert");
	
	$(".js-ready .form_submit").click(function() {
		$(this).parent().parent().find("form").submit();
	});
	
	//UNVEIL
	$("img").unveil(300);
	
//	FIX SCROLL
	 $(window).scroll(function(){
	 	didScroll=true;
	}); 
	
	$("div.scrollable").css({
		"height" : $(window).height(),
		"overflow" : "hidden"
		}).perfectScrollbar();
		
	$( ".searchbox" ).autocomplete({
      source: function( request, response ) {
        $.ajax({
          url: "search",
          type: "GET",
          dataType: "json",
          data: {
            q : $(".searchbox").val()
          },
          success: function(data) {
            console.log(data);
            response( $.map(data.items, function(item) {
        		return {
        			value: item.Title,
        			id: item.ID,
        			link: item.URLSegment
        		}
        	  }));
          }
        });
      },
      select: function( event, ui ) {
        console.log( ui.item ?
          "Selected: " + ui.item.link :
          "Nothing selected, input was " + this.value);
        window.location = ui.item.link;
        
      }
    });
    
    //$(".expand").hide();
    $(".expand-button").click(function() {
    	$(this).find("i").toggleClass("icon-angle-circled-down").toggleClass("icon-angle-circled-up");
    	$(".expand").slideToggle(500);
    });
    
    $( "html.touch" ).on( "swiperight", function() {
    	if(currentNavigation=="right") {
    		toggleRightNav();
    	}
    	else if(currentNavigation==false) {
    		toggleLeftNav();
    	}
    });
    
    $( "html.touch" ).on( "swipeleft", function() {
    	if(currentNavigation=="left") {
			toggleLeftNav();
		}
		else if(currentNavigation==false) {
			toggleRightNav();
		}
    });
    
    var showChar = 300;
    var ellipsestext = "...";
    var moretext = "More<i class='icon-right-open-1'></i>";
    var lesstext = "Less<i class='icon-left-open-1'></i>";
    var h = "";
    $('.more').each(function() {
        var content = $(this).html();
        if(content.length > showChar) {
            var c = content.substr(0, showChar);
            h = content.substr(showChar-1, content.length - showChar);
            var html = c + '<span class="moreellipses">' + ellipsestext+ '</span>' +
            	'<span class="morecontent">' + '</span> <div><a href="" class="morelink">' + moretext + '</a></div>';
            $(this).html(html);
        }
    });
 
    $(".morelink").click(function(){
        if($(this).hasClass("less")) {
            $(this).removeClass("less");
            $(this).html(moretext);
            $(this).parent().parent().find(".morecontent").html('');
        } else {
            $(this).addClass("less");
            $(this).html(lesstext);
            $(this).parent().parent().find(".morecontent").html(h);
        }
        return false;
    });
    
    /* var clickActionTimeout = null;
    
    function clearClickActionTimeout() {
      if(clickActionTimeout) {
        clearTimeout(clickActionTimeout);
        clickActionTimeout = null;
      }
    }
    
    $elem.click(function(e) {
      e.preventDefault();
      clearClickActionTimeout();
      clickActionTimeout = setTimeout(function() {
        // This was a real click if we got here...
        openPicture();
      }, 200);
    });
    
    $elem.bind('stopdrag', function() {
      clearClickActionTimeout();
    }); */
    
    
 });