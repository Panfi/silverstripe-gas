<div class="saleswrap" style="background: #000 url(<% with Image %>$CroppedImage(1000,300).URL<% end_with %>) no-repeat top center;">
	<div class="row">
		<div class="large-6 columns">
			<h1 class="white">$Title</h1>
		</div>
		<div class="large-6 columns">
			<div class="salesmessage theme-primary-underscore">
				<h4>Not an ordinary Galpin</h4>
				<p>If you are going to use a passage of Lorem Ipsum, you need to be sure there isn't anything embarrassing hidden in the middle of text.</p>
				<a href="#" class="button radius small theme-primary">Click here to purchase</a>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="shaded hsection">
<div class="row">
	<div class="large-12 columns">
		
		<% if Children %>
		<ul class="quicklinks overlayheading small-block-grid-2 large-block-grid-3">
			<% loop Children %>
			<li>
				<div class="inner">
				<a href="$Link"><img src="mysite/images/loader.gif" data-src="<% with Image %>$CroppedImage(400,400).URL<% end_with %>" />
				<h3 class="blockheading">$Title</h3>
				</a>
				</div>
			</li>
			<% end_loop %>
		</ul>
		<% end_if %>
		
		$Sections
		
		<% if Content %>
			<div class="textcontent">$Content</div>
		<% end_if %>
		
		<% include Images %>
		
		<% if VideoEmbed %>
		<div class="row">
			<div class="large-6 columns">
				<h3>Video Title and Description</h3>
				<p>Praesent sagittis ante et metus sagittis tempor. Cras feugiat purus sed massa egestas interdum. Integer in est a lacus dictum volutpat. Sed nisl nisi, tristique vitae congue ut, ultrices sed velit. Maecenas viverra in felis ac ornare. Suspendisse in augue eget neque scelerisque molestie. Suspendisse enim elit, lacinia sit amet commodo quis, iaculis ac libero. Donec a diam euismod, pharetra lectus quis, tincidunt arcu.</p>
			</div>
			<div class="large-6 columns">
				<div class="flex-video widescreen">
					$VideoEmbed.RAW
				</div>
			</div>
		</div>
		<% end_if %>
	</div>
</div>
</div>

<div class="row">
	<div class="large-12 columns">		
		<h2 class="blockheading" id="projects"><a href="#">Projects under <strong>$Title</strong></a></h2>
		
		<ul class="small-block-grid-5 blockgrid">
			<% loop Projects %>
			<% include ProjectPreview %>
			<% end_loop %>
		</ul>
		<h3 style="text-align:right;"><a href="#">See all projects <i class="icon-right-circled"></i></a></h3>
		
		<% if Tags %>
		<div class="tags">
		<h2 class="blockheading" id="projects"><a href="#">Keywords under <strong>$Title</strong></a></h2>
		<h4><ul class="inline-list">
			<% loop Tags %>
				<li><a href="$Link">$Title</a></li>
			<% end_loop %>
		</ul></h4>
		</div>
		<% end_if %>
		
		<br/>
		
		<h2 class="blockheading" id="projects"><a href="#">Vehicles for sale</a></h2>
		<ul class="small-block-grid-3 large-block-grid-6 blockgrid">
			<% loop ForSaleProjects %>
				<% include ProjectPreview %>
			<% end_loop %>
		</ul>
		<h3 style="text-align:right;"><a href="#">See all vehicles for sale <i class="icon-right-circled"></i></a></h3>

	</div>
</div>

<% include Colors %>

<% include Brands %>

		