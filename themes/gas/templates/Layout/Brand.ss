<% include Heading %>
<div class="row">
	<div class="large-12 columns">
		<% if Projects %>
		<h2>Photo Galleries</h2>
		<ul class="small-block-grid-5 blockgrid">
			<% loop Projects %>
				<% include ProjectPreview %>
			<% end_loop %>
		</ul>
		<% end_if %>
		
		<% if Categories %>
		<h3>Can be found in:</h3>
		<% loop Categories %>
			<a href="$Link" title="$title" class="button radius">$Title</a>
		<% end_loop %>
		<% end_if %>
		
		<hr />
		<p>
			<a href="brands" class="button radius">Return to <strong>All brands</strong></a>
		</p>
	</div>
</div>