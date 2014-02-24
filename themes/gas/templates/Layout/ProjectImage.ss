<div class="heading">
	<div class="row">
		<div class="large-12 columns">
			<h1 class="white">
				<a href="$Item.Link" title="Return to $Item.Title">
					<i class="icon-angle-circled-left"></i>
				</a> $Title
			</h1>
		</div>
	</div>
</div>

<div class="row layout">

	<div class="large-12 columns">
		
		$Image.Image.SetWidth(1000)
		
		<hr/>
		
		<% with Item %>

			<div class="row">
				<div class="large-8 columns">
					<a href="$Link" class="button radius" title="View $Title.XML"><i class="icon-left-circled"></i> Return to <strong>$Title</strong></a>
					<a href="photos" class="button radius" title="Search more photos"><i class="icon-search"></i> Search more photos</a>
				</div>
				<div class="large-4 columns">
					<strong class="sharetext">Share this image</strong>
					<% include AddThisButtons %>
				</div>
			</div>
		<% end_with %>
			
		<% include ProjectSalesMessage %>
			
		<h2>View other Photo Galleries</h2>
		<div class="section-container auto gassection" data-section>
		  <% loop Item.ProjectCategories %>
		  <section class="section <% if Pos==1 %>active<% end_if %>">
		    <p class="title" data-section-title><a href="#panel{$Pos}">$Title</a></p>
		    <div class="content" data-section-content>
			     <ul class="small-block-grid-3 large-block-grid-6 blockgrid">
			     	<% loop Projects %>
			     	<% include ProjectPreview %>
			     	<% end_loop %>
			     </ul>
			     <h4><a href="$Link">See all <strong>$Title</strong> <i class="icon-right-circled"></i></a></h4>
		    </div>
		  </section>
		  <% end_loop %>
		</div>

</div>
</div>

		
		