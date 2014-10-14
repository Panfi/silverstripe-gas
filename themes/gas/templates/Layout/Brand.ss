<div class="heading">
	<div class="row">
		<div class="large-8 columns">
			<h1 class="white">$Image.CroppedImage(50,50) $Title</h1>
		</div>
		<div class="large-4 columns">
			<span class="white sharetext">Share this page</span>
			<% include AddThisButtons %>
		</div>
	</div>
</div>

<% if Products %>
<div class="black">
	<div class="row">
		<div class="large-12 columns">
			<h2>Products under <strong>$Title</strong></h2>

			<div class="section-container auto gassection" data-section>
			  <dl class="sub-nav">
			  	<% loop Categories %>
			  		<dd class="<% if Active %>active<% end_if %>"><a href="$Top.Brand.Link/$URLSegment">$Title</dd>
			  	<% end_loop %>
			  </dl>
			  <div class="section <% if Pos==1 %>active<% end_if %>">
		    	<ul class="small-block-grid-3 large-block-grid-6 blockgrid">
		    	<% loop Top.Products %>
		      	<li>
		      		<a href="$Link" title="$Title.XML"><img src="mysite/images/loader.gif" data-src="<% if Image %>$Image.Image.CroppedImage(200,200).URL<% else %>http://placehold.it/200x200&text=No+image<% end_if %>" />
		      		<strong>$Title</strong></a>
		      	</li>
		      <% end_loop %>
		    	</ul>
			  </div>
		 </div>

		</div>
	</div>
</div>
<% end_if %>

<div class="row">
	<div class="large-12 columns">
		<% if Projects %>
		<h2>Our vehicles using <strong>$Title</strong> products</h2>
		<ul class="small-block-grid-5 blockgrid">
			<% loop Projects %>
				<% include ProjectPreview %>
			<% end_loop %>
		</ul>
		<hr />
		<% end_if %>
		
		
		<% if Categories %>
		<h3><strong>$Title</strong> products can be found in 
		<% loop Categories %>
			<% if Last %>and <% end_if %><a href="$Link" title="$title" class="label radius">$Title</a><% if Last %><% else %>,<% end_if %>
		<% end_loop %>
		</h3>
		<% end_if %>
		
		<hr />
		<p>
			<a href="brands" class="button radius">Return to <strong>All brands</strong></a>
		</p>
	</div>
</div>