<% include Heading %>

<div class="row layout">

	<div class="large-12 columns">
		
		<!-- <h1 class="white">$Title</h1> -->
		
		<% with Item %>		
		
		<% include ProjectImages_zoom %>
		
		<% if Content %>
			<div class="textcontent more">$Content</div>
			<hr />
		<% end_if %>
		
		<div class="row selectors hsection">
			<div class="large-4 columns">
				<div class="dropdown-wrap">
					<a href="#" data-dropdown="drop1" class="button radius expand">Related categories</a>
					<ul id="drop1" class="f-dropdown" data-dropdown-content>
						<li><a href="categories">All categories</a></li>
						<% loop Categories %>
							<li><a href="$Link">$Image.CroppedImage(40,40) $Title</a></li>
						<% end_loop %>
					</ul>
				</div>
			</div>
			<% if Tags %>
			<div class="large-4 columns">
				<div class="dropdown-wrap">
					<a href="#" data-dropdown="drop2" class="button radius expand">Related keywords</a>
					<ul id="drop2" class="f-dropdown" data-dropdown-content>
						<li><a href="tags">All tags</a></li>
						<% loop Tags %>
							<li><a href="$Link">$Title</a></li>
						<% end_loop %>
					</ul>
				</div>
			</div>
			<% end_if %>
			<div class="large-4 columns">
				<div class="dropdown-wrap">
					<a href="#" data-dropdown="drop3" class="button radius expand">Related brands</a>
					<ul id="drop3" class="f-dropdown" data-dropdown-content>
						<li><a href="brands">All our brands</a></li>
						<% loop Brands %>
							<li><a href="$Link">$Image.CroppedImage(40,40) $Title</a></li>
						<% end_loop %>
					</ul>
				</div>
			</div>
		</div>
		
		<% include ProjectSalesMessage %>
				
		<!-- <% if Tags %>
		<div class="tags">
		<h3 class="blockheading" id="projects"><a href="#">Keywords</strong></a></h3>
		<h5><ul class="inline-list">
			< % control Tags % >
				<li><a href="$Link">$Title</a></li>
			< % end_control % >
		</ul></h5>
		</div>
		<% end_if %>
		-->
		
		<% if Colors %>
		<div class="projectcolors">
		<h3 class="blockheading" id="projects">Colors</a></h3>
		<ul class="overlayheading large-block-grid-6 small-block-grid-3 blockgrid">
			<% loop Colors %>
				<li>
					<a href="$Link" title="View '$Title' this color" class="th radius">
						<div class="colorbadge" style="background:#{$Color};" ><img src="$ThemeDir/images/colortag.png" /></div>
					</a>
				</li>	
			<% end_loop %>
		</ul>
		</div>
		<% end_if %>
		
		<h2>View other Photo Galleries</h2>
		<div class="section-container auto gassection" data-section>
		  <% loop ProjectCategories %>
		  <section class="section <% if Pos==1 %>active<% end_if %>">
		    <p class="title" data-section-title><a href="#panel{$Pos}">$Title</a></p>
		    <div class="content" data-section-content>
			     <ul class="small-block-grid-3 large-block-grid-6 blockgrid">
			     	<% loop Projects %>
			     	<% include ProjectPreview %>
			     	<% end_loop %>
			     </ul>
			     <h4><a href="$Link">See all <strong>$Title</strong> <i class="icon-right-circled"></i></a></h4>
		    </div>
		  </section>
		  <% end_loop %>
		</div>
		
		<!-- <% if Brands %>
		<div class="projectbrands">
		<h3 class="blockheading"><a href="#">Brands</a></h3>
		<ul class="overlayheading large-block-grid-6 small-block-grid-3 blockgrid">
			< % control Brands % >
				<li>
					<a href="$Link" title="View '$Title' brand details" class="th radius"><img src="mysite/images/loader-light.png" data-src="< % control Image % >$WhitePaddedImage(150,150).URL< % end _ control % >" alt="$Title" /></a>
				</li>	
			< % end _ control % >
		</ul>
		</div>
		<% end_if %> -->

		<% end_with %>

</div>
</div>

		
		