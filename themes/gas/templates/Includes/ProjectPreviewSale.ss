<li>
<div class="inner">
<a href="$Link" title="$Title.XML"><img src="mysite/images/loader.gif" data-src="<% if FirstImage %><% with FirstImage %>$CroppedImage(400,300).URL<% end_with %><% else %>http://placehold.it/400x300&text=No+image<% end_if %>" />
<% if ForSale %><i class="sale <% if Sold %>sold<% end_if %>"></i><% end_if %>
</a>
<div class="details">
	<h5>$Title</h5>
	$CarMake.Title <% if CarModel.Title %>$CarModel.Title<% else %>&nbsp;<% end_if %>
</div>
</div>
</li>