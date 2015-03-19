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
					<h2><strong>$Title</strong> Products</h2>
				</div>
				<div class="large-4 columns">

					<form class="productsearchform" action="$Brand.Link" data-posttype="Product" data-brandid="$Brand.ID" data-categoryid="$SubCategory" method="get">
						
						<div class="row">
						<div class="ui-widget large-12 columns">
						  <span class="ui-helper-hidden-accessible">&nbsp;</span>
						  <div class="row collapse">
						  	<div class="small-11 columns">
						  		<input type="text" placeholder="Type name of product" class="productsearchbox" name="q" value="$SearchTerm">
						  		<input type="hidden" name="categoryID" value="$SubCategory">
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

			<div class="row">
				<div class="large-8 columns">
					<dl class="sub-nav">
				  	<% loop Categories %>
				  		<dd class="<% if Active %>active<% end_if %>"><a href="{$Top.Brand.Link}/{$URLSegment}">$Title</a></dd>
				  	<% end_loop %>
				  </dl>
				</div>
				<div class="large-4 columns text-right result-count">
						<% if Products %>
						<p><i class="icon-target icon"></i> <strong>$Products.Count</strong> <span>( <strong>$Products.CurrentPage</strong> / <strong>$Products.TotalPages</strong> )</span>
						  <% if ProductGroups %>
					  		<span class="dropdown-wrap filter-dropdown">
									<a href="#" data-dropdown="drop1" class="button button-white small round">$FilterTitle <i class=" icon-down-open"></i></a>
									<ul id="drop1" class="f-dropdown filter-dropdown-inner" data-dropdown-content>
										<% loop ProductGroups %>
											<li><a href="$Link">{$ProductGroup}</a></li>
										<% end_loop %>
										<li><a href="$Link">-- SHOW ALL --</a></li>
									</ul>
								</span>
							<% end_if %>
						</p>
					<% end_if %>
				</div>
			</div>

		  <% if SearchCategories %>
			<div data-alert class="alert-box search-suggestions">
				<h4><i class="icon-search"></i> Search <strong>suggestions</strong></h4>
		  	<p>Are you looking for <strong><a href="$Top.Brand.Link">$Top.Brand.Title</a></strong> <% loop SearchCategories %><a href="$Top.Brand.Link/$URLSegment">$Title</a><% if not Last %>, <% end_if %><% end_loop %>?</p>
		  	<a href="#" class="close">&times;</a>
		  </div>
		  <% end_if %>			

		  <% if ResultTitle %>
		  	<h4>$ResultTitle</h4>
		  <% end_if %>

			<div class="productwrap">

			  <% if $Products %>

			  <!-- <div class="section <% if Pos==1 %>active<% end_if %>"> -->
		    	<ul class="small-block-grid-3 large-block-grid-4 blockgrid product-grid">
		    	<% loop $Products %>
		      	<li>
		      		<a href="$Link" title="$Title.XML"><img src="mysite/images/loader.gif" data-src="$ThumbnailURL(300)" />
		      		<h4 class="product-title"><span>$Title</span></h4></a>
		      	</li>
		      <% end_loop %>
		    	</ul>


	    	<% if $Products.MoreThanOnePage %>
	    	<h4><ul class="pagination">
			    <% if $Products.NotFirstPage %>
			    	<li class="arrow"><a href="$Products.PrevLink"><i class="icon icon-left-open"></i></a></li>
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
			   		 <li class="arrow"><a href="$Products.NextLink"><i class="icon icon-right-open"></i></a></li>
			    <% end_if %>
				</ul></h4>
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
		<hr />
		<% end_if %>
		
		<p>
			<a href="brands" class="button radius">Return to <strong>All brands</strong></a>
		</p>
	</div>
</div>