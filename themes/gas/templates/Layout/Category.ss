<% include Heading %>

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
				
		$Message
		
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
		
		<% include Brands %>
	
		<div class="subsection projects">
			<h2 class="blockheading" id="projects"><a href="{$Link}all">Photos under <strong>$Title</strong></a></h2>
			<ul class="small-block-grid-5 blockgrid">
				<% loop getProjects %>
					<% include ProjectPreview %>
				<% end_loop %>
			</ul>
			<h3 style="text-align:right;"><a href="{$Link}all">See all Photos <i class="icon-right-circled"></i></a></h3>
		</div>
		
		
		<div class="subsection vehicles-for-sale">
			<h2 class="blockheading" id="projects"><a href="vehicles-for-sale?Category=$ID">Vehicles for sale</a></h2>
			<ul class="small-block-grid-3 large-block-grid-6 blockgrid">
				<% loop ForSaleProjects %>
					<% include ProjectPreview %>
				<% end_loop %>
			</ul>
			<h3 style="text-align:right;"><a href="vehicles-for-sale?Category=$ID">See all vehicles for sale <i class="icon-right-circled"></i></a></h3>
		</div>
		
		<% include Colors %>

	</div>
</div>