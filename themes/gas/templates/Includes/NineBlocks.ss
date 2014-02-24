<% if Children %>
<ul class="quicklinks overlayheading small-block-grid-2 large-block-grid-3">
	<% loop Children %>
	<li>
		<div class="inner">
		<a href="$Link"><img src="$Image.CroppedImage(400,300).URL" />
		<h3 class="blockheading">$Title <% include AddThisShare %></h3>
		</a>
		</div>
	</li>
	<% end_loop %>
</ul>
<!-- <h3><a href="$Link"><i class="icon-th-list"></i> Go to <strong>$Title</strong></a></h3> -->
<% else %>
	<div class="row">
		<div class="large-8 columns largebox push-4">
			<a href="$Link">$Image.CroppedImage(808,400)</a>
		</div>
		<div class="large-4 columns smallbox pull-8">
			<div class="boxwrap">
				<img src="$ThemeDir/images/1x1-pixel.png" width="400" height="400" />
				<div class="textwrap box" style="max-width:100%;">
					<h3 <% if MainColor %>style="color:#{$MainColor} !important;"<% end_if %> >$Title</h3>
					<% if Summary %>
						<p>$Summary</p>
					<% else %>
						<p>$Content.Summary(30)</p>
					<% end_if %>
				</div>
			</div>
		</div>
	</div>
	<h3 class="right-align"><a href="$Link">Enter our <strong>$Title</strong> division <i class="icon-angle-circled-right"></i></a></h3>
<% end_if %>