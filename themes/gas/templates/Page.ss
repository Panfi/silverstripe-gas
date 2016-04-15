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
  <script src="//code.jquery.com/jquery-1.11.2.min.js"></script>

  <% include Theming %>

</head>

<body class="$ClassName $URLSegment">

	<% include Menus %>

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
				<p class="address"><a href="http://maps.google.com?q=15600 Roscoe Blvd, Van Nuys, CA 90014" target="_blank">15600 Roscoe Blvd., Van Nuys, CA 91406 <i class="icon icon-direction"></i></a></p>
				<p class="call">Call today <a class="button small radius" href="tel:+8774642746">877-GO-GAS-GO</a></p>
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

</div>

<% include ContactModal %>
<% include SubscribeModal %>

$ExtraJavascript

<script>
  <% include GoogleAnalytics %>
  <% include AddThis %>
</script>

</body>
</html>
