<% if Images %>
<% if ImageCount==1 %>
	<a class="photo"><img src="$Large(1000)" alt="<% if Caption %>$Caption<% else %>Image-$Pos<% end_if %>" /></a>
<% else %>
	<div class="galleria"></div>
<% end_if %>
<% end_if %>