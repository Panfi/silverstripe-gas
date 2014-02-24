<li><a href="$Link" title="$Title.XML"><img src="mysite/images/loader.gif" data-src="<% if FirstImage %><% with FirstImage %>$CroppedImage(200,200).URL<% end_with %><% else %>http://placehold.it/200x200&text=No+image<% end_if %>" />
<% if ForSale %><i class="sale <% if Sold %>sold<% end_if %>"></i><% end_if %>
</a></li>