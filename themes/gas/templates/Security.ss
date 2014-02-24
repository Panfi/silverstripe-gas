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
  <!-- <script src="mysite/foundation/js/vendor/custom.modernizr.js"></script> -->
  <script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
  
</head>

<body class="Security">
	
	
	<div id="inner-wrap">		
	<div class="layout">
		<div class="heading">
			<div class="row">
				<div class="large-9 large-centered columns">
					<h1 class="white">$Title</h1>
				</div>
			</div>
		</div>
		
		<div class="row">
			<div class="large-9 large-centered columns">
		
				$Message
				<% if VideoEmbed %><div class="flex-video widescreen">$VideoEmbed.RAW</div><% end_if %>
				<% if Content %>
					<div class="textcontent">$Content</div>
				<% end_if %>
				$CustomHtml.RAW
				$Form
			</div>
		</div>
		
	</div>
	</div>
	
	<script>
	  $(document).foundation();
	    <% include GoogleAnalytics %>
	  
	</script>
  	
</body>
</html>
