/*!
 *
 *  Copyright (c) Design Collective
 *
 */

$(document).foundation();

var currentNavigation = false,
	didScroll = false;

function toggleLeftNav() {
	console.log("Left nav toggle");
	if(currentNavigation!="left") {
//		$(".sidenav-right").hide();
		// $(".sidenav-left").show();
		$(document.documentElement).removeClass("js-nav-right").addClass("js-nav-left");
		currentNavigation = "left";
	} else {
		$(document.documentElement).removeClass("js-nav-left");
		// setTimeout(function() {
		// 	$(".sidenav-left").hide();
		// }, 800);
		currentNavigation = false;
	}
}

function toggleRightNav() {
	console.log("Right nav toggle");
	if(currentNavigation!="right") {
//		$(".sidenav-left").hide();
		// $(".sidenav-right").show();
		$(document.documentElement).removeClass("js-nav-left").addClass("js-nav-right");
		currentNavigation = "right";
	} else {
		$(document.documentElement).removeClass("js-nav-right");
		// setTimeout(function() {
		// 	$(".sidenav-right").hide();
		// }, 800);
		currentNavigation = false;
	}
}

function reflowSections() {
	$('div.section').foundation('section','reflow').fadeIn();
}

$(document).ready(function() {

	console.log("Document ready.");
	$(document.documentElement).addClass("js-ready");

  if($(".moretext")) {
    $(".moretext").readmore({ maxHeight: 200 });
  }
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


	// if($(document).width() > 760) {
	// 	setInterval(function() {
	// 		if(didScroll) {
	// 			didScroll=false;
	// 			$('.fix-y').each(function() {
	// 				dy = $(this).data("dy");
	// 				//console.log($(this).css("top"));
	// 				if($(this).hasClass('animate')) {
	// 					$(this).stop(true).animate({'top': $(window).scrollTop() + dy},500,'easeOutQuad');
	// 				}
	// 				else {
	// 					$(this).css({'top': $(window).scrollTop() + dy});
	// 				}
	// 			});
	// 		}
	// 	},250);
	// 	//	FIX SCROLL
	// 	$(window).scroll(function(){
	// 	 	didScroll=true;
	// 	});
	// }

	if($("div.scrollable").length) {
  	$("div.scrollable").css({
  		"height" : $(window).height(),
  		"overflow" : "hidden"
  		}).perfectScrollbar();
  }

  if($(".searchbox").length) {
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
    }

    if($(".productsearchbox").length) {

      $(".productsearchbox" ).autocomplete({

        source: function( request, response ) {

          var id = this.element.attr('id');
          console.log(id);
          console.log("Brand: "+$(".productsearchform").data("brandid"));
          console.log("Category: "+$(".productsearchform").data("categoryid"));
          f = $(".productsearchform");
          $.ajax({
            url: "search",
            type: "GET",
            dataType: "json",
            data: {
              type: "Product",
              brandID: f.data("brandid"),
              categoryID: f.data("categoryid"),
              q: $(".productsearchbox").val()
            },
            success: function(data) {
              console.log(data);
              response( $.map(data.items, function(item) {
              return {
                value: item.Title,
                id: item.ID,
                link: item.Link,
                thumb: item.Thumbnail,
                text: item.Text
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
      }).data("ui-autocomplete")._renderItem = function (ul, item) {
          ul.addClass("product-autocomplete");
          // console.log(item);
          return $("<li></li>")
             .data("item.autocomplete", item)
             .append("<a><div class='row'><div class='small-2 medium-3 columns'><img src='" + item.thumb + "' /></div><div class='small-10 medium-9 columns'><h4>" + item.value + "</h4><p>" + item.text + "</p><span class='button button-primary'>Read more</span></div></div></a>")
             .appendTo(ul);
       };
    }

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

    /* var showChar = 300;
    var morebutton = "<a class='morelink more' href='#'>More<i class='icon-right-open-1'></i></a>";
    var lessbutton = "<a class='morelink less' href='#'>Less<i class='icon-left-open-1'></i></a>";
    var h = "";
    $('.more').each(function() {
        var content = $(this).html();
        if(content.length > showChar) {
            var c = content.substr(0, showChar);
            h = content.substr(showChar-1, content.length - showChar);

            var html = c + '<span class="moretext">...</span>' + morebutton + '<remainder class="moretext" style="display:none !important;">' + h + lessbutton + '</span>';
            	// '<span class="morecontent">' + '</span> <div><a href="" class="morelink">' + moretext + '</a></div>';
            $(this).html(html);
        }
    });

    $(".morelink").click(function(){
        $(".moretext").toggle();
        $(".morelink").toggle();
        // if($(this).hasClass("less")) {
        //     $(this).removeClass("less");
        //     $(this).html(moretext);
        //     $(this).parent().parent().find(".morecontent").html('');
        // } else {
        //     $(this).addClass("less");
        //     $(this).html(lesstext);
        //     $(this).parent().parent().find(".morecontent").html(h);
        // }
        return false;
    }); */

    $(".ProfilePage .profile a").click(function(evt) {
    	evt.preventDefault();
    	$a = $("#profileModal");
    	$a.find(".title").html($(this).data("title"));
    	$a.find("img").attr("src", $(this).data("image"));
    	$a.find(".jobposition").html($(this).data("jobposition"));
    	$a.find(".text").html($(this).data("text"));
    	$a.find(".phone").html($(this).data("phone"));
    	$a.find(".email span").html($(this).data("email"));
    	$a.find(".email").attr("href", $(this).data("email"));
    	$("#profileModal").foundation("reveal","open");
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


;(function($) {

  var readmore = 'readmore',
      defaults = {
        speed: 100,
        maxHeight: 200,
        heightMargin: 16,
        moreLink: '<a href="#">Read More</a>',
        lessLink: '<a href="#">Close</a>',
        embedCSS: true,
        sectionCSS: 'display: block; width: 100%;',
        startOpen: false,
        expandedClass: 'readmore-js-expanded',
        collapsedClass: 'readmore-js-collapsed',

        // callbacks
        beforeToggle: function(){},
        afterToggle: function(){}
      },
      cssEmbedded = false;

  function Readmore( element, options ) {
    this.element = element;

    this.options = $.extend( {}, defaults, options);

    $(this.element).data('max-height', this.options.maxHeight);
    $(this.element).data('height-margin', this.options.heightMargin);

    delete(this.options.maxHeight);

    if(this.options.embedCSS && ! cssEmbedded) {
      var styles = '.readmore-js-toggle, .readmore-js-section { ' + this.options.sectionCSS + ' } .readmore-js-section { overflow: hidden; }';

      (function(d,u) {
        var css=d.createElement('style');
        css.type = 'text/css';
        if(css.styleSheet) {
            css.styleSheet.cssText = u;
        }
        else {
            css.appendChild(d.createTextNode(u));
        }
        d.getElementsByTagName('head')[0].appendChild(css);
      }(document, styles));

      cssEmbedded = true;
    }

    this._defaults = defaults;
    this._name = readmore;

    this.init();
  }

  Readmore.prototype = {

    init: function() {
      var $this = this;

      $(this.element).each(function() {
        var current = $(this),
            maxHeight = (current.css('max-height').replace(/[^-\d\.]/g, '') > current.data('max-height')) ? current.css('max-height').replace(/[^-\d\.]/g, '') : current.data('max-height'),
            heightMargin = current.data('height-margin');

        if(current.css('max-height') != 'none') {
          current.css('max-height', 'none');
        }

        $this.setBoxHeight(current);

        if(current.outerHeight(true) <= maxHeight + heightMargin) {
          // The block is shorter than the limit, so there's no need to truncate it.
          return true;
        }
        else {
          current.addClass('readmore-js-section ' + $this.options.collapsedClass).data('collapsedHeight', maxHeight);

          var useLink = $this.options.startOpen ? $this.options.lessLink : $this.options.moreLink;
          current.after($(useLink).on('click', function(event) { $this.toggleSlider(this, current, event) }).addClass('readmore-js-toggle'));

          if(!$this.options.startOpen) {
            current.css({height: maxHeight});
          }
        }
      });

      $(window).on('resize', function(event) {
        $this.resizeBoxes();
      });
    },

    toggleSlider: function(trigger, element, event)
    {
      event.preventDefault();

      var $this = this,
          newHeight = newLink = sectionClass = '',
          expanded = false,
          collapsedHeight = $(element).data('collapsedHeight');

      if ($(element).height() <= collapsedHeight) {
        newHeight = $(element).data('expandedHeight') + 'px';
        newLink = 'lessLink';
        expanded = true;
        sectionClass = $this.options.expandedClass;
      }

      else {
        newHeight = collapsedHeight;
        newLink = 'moreLink';
        sectionClass = $this.options.collapsedClass;
      }

      // Fire beforeToggle callback
      $this.options.beforeToggle(trigger, element, expanded);

      $(element).animate({'height': newHeight}, {duration: $this.options.speed, complete: function() {
          // Fire afterToggle callback
          $this.options.afterToggle(trigger, element, expanded);

          $(trigger).replaceWith($($this.options[newLink]).on('click', function(event) { $this.toggleSlider(this, element, event) }).addClass('readmore-js-toggle'));

          $(this).removeClass($this.options.collapsedClass + ' ' + $this.options.expandedClass).addClass(sectionClass);
        }
      });
    },

    setBoxHeight: function(element) {
      var el = element.clone().css({'height': 'auto', 'width': element.width(), 'overflow': 'hidden'}).insertAfter(element),
          height = el.outerHeight(true);

      el.remove();

      element.data('expandedHeight', height);
    },

    resizeBoxes: function() {
      var $this = this;

      $('.readmore-js-section').each(function() {
        var current = $(this);

        $this.setBoxHeight(current);

        if(current.height() > current.data('expandedHeight') || (current.hasClass($this.options.expandedClass) && current.height() < current.data('expandedHeight')) ) {
          current.css('height', current.data('expandedHeight'));
        }
      });
    },

    destroy: function() {
      var $this = this;

      $(this.element).each(function() {
        var current = $(this);

        current.removeClass('readmore-js-section ' + $this.options.collapsedClass + ' ' + $this.options.expandedClass).css({'max-height': '', 'height': 'auto'}).next('.readmore-js-toggle').remove();

        current.removeData();
      });
    }
  };

  $.fn[readmore] = function( options ) {
    var args = arguments;
    if (options === undefined || typeof options === 'object') {
      return this.each(function () {
        if ($.data(this, 'plugin_' + readmore)) {
          var instance = $.data(this, 'plugin_' + readmore);
          instance['destroy'].apply(instance);
        }

        $.data(this, 'plugin_' + readmore, new Readmore( this, options ));
      });
    } else if (typeof options === 'string' && options[0] !== '_' && options !== 'init') {
      return this.each(function () {
        var instance = $.data(this, 'plugin_' + readmore);
        if (instance instanceof Readmore && typeof instance[options] === 'function') {
          instance[options].apply( instance, Array.prototype.slice.call( args, 1 ) );
        }
      });
    }
  }

})(jQuery);
