<div class="sidebar">

<!-- CHILDREN -->
<% if Children %>
<div class="sidebox children">
	<h3>Related pages</h3>
	<ul>
	<% loop Children %>
		<li><a href="$Link">$MenuTitle</a></li>
	<% end_loop %>
	</ul>
</div>
<% end_if %>

<div class="sidebox siblings hide-for-small">
<!-- <h4 class="blockheading">Related categories</h4> -->
<% loop RandomPages(3) %>
	<a href="$Link">$Image.CroppedImage(400,250)</a>
	<div class="boxwrap sideBox">
		<div class="textwrap box" style="max-width:100%;">
			<a href="$Link">
				<h4 class="white">$Title</h4>
				<p>Read more<i class="icon-right-open-1"></i></p>
			</a>
			<!-- <p>$Content.Summary(20)</p> -->
		</div>
	</div>
<% end_loop %>
</div>


$Sidebar

</div>