<% if Colors %>
<div class="colors subsection">
	<div class="row">
	<div class="large-12">
		<h2 class="blockheading"><a href="#">Browse by color</a></h2>
		<ul class="overlayheading large-block-grid-6 small-block-grid-4 blockgrid">
			<% loop Colors %>
				<li>
					<a href="$Link" title="View '$Title' this color" class="th radius">
						<div class="colorbadge" style="background:#{$Color};" ><img src="$ThemeDir/images/colortag.png" /></div>
					</a>
				</li>	
			<% end_loop %>
		</ul>
	</div>
	</div>
</div>
<% end_if %>