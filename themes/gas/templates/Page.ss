<!DOCTYPE html>

<!-- paulirish.com/2008/conditional-stylesheets-vs-css-hacks-answer-neither/ -->
<!--[if IE 8]>    <html class="no-js lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
<head>
  <meta charset="utf-8" />

  <!-- Set the viewport width to device width for mobile -->
  <meta name="viewport" content="width=device-width" />
  <% base_tag %>
  <title>$SiteConfig.Title | <% if MetaTitle %>$MetaTitle<% else %>$Title<% end_if %></title>
  $MetaTags(false)
  
  <!-- Included CSS Files (Uncompressed) -->
  <!--
  <link rel="stylesheet" href="stylesheets/foundation.css">
  -->
  
  <!-- Included CSS Files (Compressed) -->
  <link rel="shortcut icon" href="favicon.ico">
  <link rel="stylesheet" href="mysite/foundation/css/foundation.min.css" />
  <link rel="stylesheet" media="screen" href="$ThemeDir/css/style.css" />
  <link rel="stylesheet" media="print" href="$ThemeDir/css/print.css" />
  <link rel="stylesheet" href="mysite/fontello/css/fontello.css" />
  <link rel="stylesheet" href="mysite/fontello/css/animation.css" /><!--[if IE 7]>
  <link rel="stylesheet" href="mysite/fontello/css/fontello-ie7.css" /><![endif]-->
  <link rel="image_src" href="$ThumbnailURL" />
  <script src="mysite/foundation/js/vendor/custom.modernizr.js"></script>
  <script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
  
  <% include Theming %>
  
</head>

<body class="$ClassName $URLSegment">
	
	<div id="outer-wrap">

	<% include Menus %>
	
	<div id="inner-wrap">

		<% include InnerMenu %>
		
		<div class="headerwrap">
			<div class="row">
				<div class="large-4 columns header-left">
					<a href="./"><img src="$ThemeDir/images/Logo.png" /></a>
				</div>
				<div class="large-4 columns header-center">
					<div class="tagline">automotive custom shop</div>					

					<form class="searchform" action="search">
						<i class="icon-search"></i>
						
						<div class="row">
						<div class="ui-widget large-12 columns">
						  <span class="ui-helper-hidden-accessible">&nbsp;</span>
						  <input type="text" placeholder="Search..." class="searchbox" name="q" value="$SearchTerm">
						  <input type="submit" style="position: absolute; left: -9999px; width: 1px; height: 1px;" />
						</div>
						</div>
					    
					</form>

				</div>
				<div class="large-4 columns header-right">
					<p class="address">15600 Roscoe Blvd., Van Nuys, CA 91406 <a href="http://maps.google.com?q=15600 Roscoe Blvd, Van Nuys, CA 90014" target="_blank"><i class="icon-direction"></i></a></p>
					<p class="call">Call today <a class="button small radius" href="tel:877-GO-GAS-GO">877-GO-GAS-GO</a></p>
				</div>
			</div>
		</div>
		
		<% include TopMenu %>
			
		<div class="layout">			
			$Layout
			<% include SocialBlock %>
			<% include Updates %>
			<% include Footer %>
		</div>
		<% include AddThis %>
	</div>
	</div>
	
	<% include ContactModal %>
	

	<!-- <script>
	document.write('<script src=' +
	('__proto__' in {} ? 'mysite/foundation/js/vendor/zepto' : 'mysite/foundation/js/vendor/jquery') +
	'.js><\/script>')
	</script> -->
	
	
	<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
	<script src="mysite/zozotabs/js/zozo.tabs.min.js"></script>
	$ExtraJavascript
	<!-- <script src="http://code.jquery.com/mobile/1.3.2/jquery.mobile-1.3.2.min.js"></script> -->
	<!-- <script src="mysite/foundation/js/foundation.min.js"></script> -->
	<!--
	
	<script src="js/foundation/foundation.js"></script>
	
	<script src="js/foundation/foundation.abide.js"></script>
	
	<script src="js/foundation/foundation.dropdown.js"></script>
	
	<script src="js/foundation/foundation.placeholder.js"></script>
	
	<script src="js/foundation/foundation.forms.js"></script>
	
	<script src="js/foundation/foundation.alerts.js"></script>
	
	<script src="js/foundation/foundation.magellan.js"></script>
	
	<script src="js/foundation/foundation.reveal.js"></script>
	
	<script src="js/foundation/foundation.tooltips.js"></script>
	
	<script src="js/foundation/foundation.orbit.js"></script>
	
	<script src="js/foundation/foundation.section.js"></script>
	
	<script src="js/foundation/foundation.topbar.js"></script>
	
	-->
	<!-- <script type="text/javascript">
	    less = {
	        env: "development", // or "production"
	        async: false,       // load imports async
	        fileAsync: false,   // load imports async when in a page under
	                            // a file protocol
	        poll: 1000,         // when in watch mode, time in ms between polls
	        functions: {},      // user functions, keyed by name
	        dumpLineNumbers: "comments", // or "mediaQuery" or "all"
	        relativeUrls: false,// whether to adjust url's to be relative
	                            // if false, url's are already relative to the
	                            // entry less file
	        rootpath: ":/gas/"// a path to add on to the start of every url
	                            //resource
	    };
	    less.watch();
	</script> -->
	<script>
	  $(document).foundation();
	  <% include GoogleAnalytics %>
	</script>
  	
</body>
</html>
