<% include Heading %>

<% if Brands %>
<div class="subsection">
	<div class="row">
	<div class="large-12">
			<ul class="overlayheading large-block-grid-9 small-block-grid-3 blockgrid">
				<% loop Brands %>
					<li>
						<a href="$Link" title="View '$Title' brand details"><img src="mysite/images/loader-light.png" data-src="<% with Image %>$WhitePaddedImage(150,150).URL<% end_with %>" alt="$Title" /></a>
					</li>	
				<% end_loop %>
			</ul>
			<% if Category %>
				<hr />
				<p>
					<a href="brands" class="button radius">Return to <strong>All brands</strong></a>
					<% with Category %><a href="$Link" class="button radius" title="Go to $Title.XML">Go to <strong>$Title</strong></a><% end_with %>
				</p>
			<% end_if %>
	</div>
	</div>
</div>
<% end_if %>