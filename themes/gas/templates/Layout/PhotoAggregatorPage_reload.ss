<% loop Photos %>
<li class="item">
	<a href="$Large" data-sharelink="$Link" data-projectlink="$Project.Link" data-projecttitle="$Project.Title" class="photo" data-imagelink="$AbsoluteLink">$Image.SetWidth(400)</a>
</li>
<% end_loop %>