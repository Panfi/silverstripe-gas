<div class="heading">
	<div class="row">
		<div class="large-8 columns">
			<h1 class="white">$Brand.Image.CroppedImage(100,100) $Title</h1>
		</div>
		<div class="large-4 columns">
			<span class="white sharetext">Share this page</span>
			<% include AddThisButtons %>
		</div>
	</div>
</div>

<div class="whitebg">
	<div class="row">
		<div class="large-12 columns">
			<div class="row">
				<div class="large-8 columns">
					<h2>Products under <strong>$Title</strong></h2>
				</div>
				<div class="large-4 columns">

					<form class="productsearchform" action="$Brand.Link" data-posttype="Product" data-brandid="$Brand.ID" method="get">
						
						<div class="row">
						<div class="ui-widget large-12 columns">
						  <span class="ui-helper-hidden-accessible">&nbsp;</span>
						  <div class="row collapse">
						  	<div class="small-11 columns">
						  		<input type="text" placeholder="Type name of product" class="productsearchbox" name="q" value="$SearchTerm">
						  		<% loop ProductSearchForm.Fields %>
						  			$Field
						  		<% end_loop %>
						  	</div>
						  	<div class="small-1 columns">
						  		<span class="postfix"><i class="icon-search"></i></span>
						  	</div>
						  </div>
						  
						</div>
						</div>
					    
					</form>

				</div>
			</div>				

			<div class="productwrap">
			  
			  <dl class="sub-nav">
			  	<% loop Categories %>
			  		<dd class="<% if Active %>active<% end_if %>"><a href="{$Top.Brand.Link}/{$URLSegment}">$Title</a></dd>
			  	<% end_loop %>
			  </dl>

			  <% if $Products %>
			  <!-- <div class="section <% if Pos==1 %>active<% end_if %>"> -->
		    	<ul class="small-block-grid-3 large-block-grid-4 blockgrid product-grid">
		    	<% loop $Products %>
		      	<li>
		      		<a href="$Link" title="$Title.XML"><img src="mysite/images/loader.gif" data-src="<% if Image %>$Image.Image.CroppedImage(200,200).URL<% else %>http://placehold.it/200x200&text=No+image<% end_if %>" />
		      		<h4 class="product-title"><span>$Title</span></h4></a>
		      	</li>
		      <% end_loop %>
		    	</ul>


	    	<% if $Products.MoreThanOnePage %>
	    	<ul class="pagination">
			    <% if $Products.NotFirstPage %>
			    	<li class="arrow"><a href="$Products.PrevLink">&laquo;</a></li>
			    <% end_if %>

			    <% loop Products.PaginationSummary(9) %>
			  		<% if $CurrentBool %>
			      	<li class="current"><a href="">$PageNum</a></li>
			      <% else %>
		        	<% if $Link %>
		        		<li><a href="$Link">$PageNum</a></li>
		        	<% else %>
		        		<li class="unavailable"><a href="">&hellip;</a></li>
		        	<% end_if %>
		        <% end_if %>
			 		<% end_loop %>

			    <% if $Products.NotLastPage %>
			   		 <li class="arrow"><a href="$Products.NextLink">&raquo;</a></li>
			    <% end_if %>
				</ul>
				<% end_if %>

			  <!-- </div> -->
			  <% else %>
			  	<p>No products found.</p>
			  <% end_if %>

			  <!-- <center><a href="#" class="loadmore">Load more</a></center> -->
			</div>

		</div>
	</div>
</div>

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
			<% if Count>1 && Last %>and <% end_if %><a href="$Link" title="$title" class="label radius">$Title</a><% if Last %><% else %>,<% end_if %>
		<% end_loop %>
		</h3>
		<% end_if %>
		
		<hr />
		<p>
			<a href="brands" class="button radius">Return to <strong>All brands</strong></a>
		</p>
	</div>
</div>