<% include Heading %>
<% include Images %>

<div class="row layout">

	<div class="large-3 columns push-9">
		<% include Sidebar %>
	</div>
	<div class="large-9 columns pull-3">
		<% if Content %><div class="maincontent panel">
			$Content
		</div>
		<% end_if %>
			<% if Specials %>
			
			<% loop Specials %>
				<div class="article">
					<a href="$Link">
						<% if Image %><center>$Image.SetWidth(800)</center><% end_if %>
					<div class="details">
						<h3>$Title</h3>
						<% if Content %><p class="summary">$Content.Summary(30)</p><% end_if %>
					</div>
					<% include AddThisShareItem %>
					</a>
				</div>
				<hr />
			<% end_loop %>
			
			<% if Specials.MoreThanOnePage %> 
				<ul class="pagination">
					<% if Specials.PrevLink %> 
				  		<li class="arrow"><a href="$Specials.PrevLink">&laquo;</a></li>
				  	<% else %>
				  		<li class="arrow unavailable"><a href="">&laquo;</a></li>
				  	<% end_if %>
				  	
				  	<% with Specials.PaginationSummary(9) %>
				  		<% if CurrentBool %>
				 			<li class="current round"><a href="#">$PageNum</a></li>
				 		<% else %>
				 			<% if Link %>
				 				<li><a href="$Link">$PageNum</a></li>
				 			<% else %>
				 				<li class="unavailable"><a href="">&hellip;</a></li>
				 			<% end_if %>
				 		<% end_if %>
				 	<% end_with %>
				 	
				 	<% if Specials.NextLink %> 
				 		<li class="arrow"><a href="$Specials.NextLink">&raquo;</a></li>
				 	<% else %>
				 		<li class="arrow unavailable"><a href="">&raquo;</a></li>
				 	<% end_if %>
				 </ul>
			<% end_if %>
			
			<% end_if %>
	</div>
</div>