<% if Brands %>
	<div class="row">
	<div class="large-12">
			<h2 class="blockheading">
				<% if ClassName==Category %>
					<a href="/brands?Category={$ID}">Our <strong>$Title</strong> brands</a>
				<% else %>
					<a href="/brands">Our brands</a>
				<% end_if %>
			</h2>
			<ul class="overlayheading large-block-grid-9 small-block-grid-3 blockgrid">
				<% loop Brands %>
					<li>
						<a href="$Link" title="View '$Title' brand details"><img src="mysite/images/loader-light.png" data-src="<% with Image %>$WhitePaddedImage(150,150).URL<% end_with %>" alt="$Title" /></a>
					</li>	
				<% end_loop %>
			</ul>
	</div>
	</div>
<% end_if %>