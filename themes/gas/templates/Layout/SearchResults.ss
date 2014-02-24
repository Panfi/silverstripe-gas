<% include Heading %>
<div class="row">
	<div class="large-12 columns SearchResults">		
		<% with SearchResults %>
		
		<h3 class="blockheading">Photo galleries ($Projects.Count)</h3>
		<% if Projects %>
		<ul class="large-block-grid-5 small-block-grid-3">
		<% loop Projects %>
			<% include ProjectPreview %>
		<% end_loop %>
		</ul>
		<% end_if %>
		
		<% if News %>
		<h3 class="blockheading">News & Updates ($News.Count)</h3>
		<ul class="large-block-grid-5 small-block-grid-3">
		<% loop News %>
			<li><a href="$Link"><img src="$ThumbnailURL"></a></li>
		<% end_loop %>
		</ul>
		<% end_if %>
		
		<% if Specials %>
		<h3 class="blockheading">Specials ($Specials.Count)</h3>
		<ul class="large-block-grid-3 small-block-grid-2">
		<% loop Specials %>
			<li><a href="$Link"><img src="$ThumbnailURL"></a></li>
		<% end_loop %>
		</ul>
		<% end_if %>
		
		<% if Tags %>
		<h3 class="blockheading">Tags ($Tags.Count)</h3>
		<h4><ul class="inline-list">
			<% loop Tags %>
				<li><a href="$Link">$Title</a></li>
			<% end_loop %>
		</ul></h4>
		<% end_if %>
		
		<% if Pages %>
		<h3 class="blockheading">Pages ($Pages.Count)</h3>
		<ul class="large-block-grid-6 small-block-grid-3">
		<% loop Pages %>
			<li><a href="$Link"><img src="$ThumbnailURL" /><strong>$Title</strong></a></li>
		<% end_loop %>
		</ul><% end_if %>
		
		<% end_with %>
	</div>
</div>