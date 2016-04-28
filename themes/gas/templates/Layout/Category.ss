<% include Heading %>

<div class="row">
	<div class="large-12 columns">

		<% if Children %>
		<ul class="quicklinks overlayheading small-block-grid-2 large-block-grid-3">
			<% loop Children %>
			<li>
				<div class="inner">
				<a href="$Link"><img src="mysite/images/loader.gif" data-src="<% with Image %>$CroppedImage(400,400).URL<% end_with %>" />
				<h3 class="blockheading">$Title</h3>
				</a>
				</div>
			</li>
			<% end_loop %>
		</ul>
		<% end_if %>

		$Message

		<% if Content %>
			<div class="textcontent">$Content</div>
		<% end_if %>

		<% if not HidePhotoSlider %>
			<% include Images %>
		<% end_if %>

			<div class="section p-t-20 p-b-20">
				<div class="row">

					<div class="large-6 columns push-6">
						<div class="flex-video widescreen">
							<% if VideoEmbed %>
								$VideoEmbed.RAW
							<% end_if %>
						</div>
					</div>

					<div class="large-6 columns pull-6">
						<% if SubCategoryButtons %>
							<ul class="small-block-grid-2 large-block-grid-2 blockgrid">
								<% loop SubCategoryButtons %>
									<li class="subCategory">
											<h3><% if $HtmlTitle %>$HtmlTitle.RAW<% else %>$Title<% end_if %></h3>
											<img src="$Image.CroppedImage(640,400).URL" />
									</li>
								<% end_loop %>
							</ul>
						<% end_if %>
					</div>

				</div>
			</div>

		<% if HideBrand %><% else %>
			<% include Brands %>
		<% end_if %>

		<% if HidePhotos %><% else %>
		<div class="subsection projects">
			<h2 class="blockheading" id="projects"><a href="{$Link}all">Photos under <strong>$Title</strong></a></h2>
			<ul class="small-block-grid-5 blockgrid">
				<% loop getProjects %>
					<% include ProjectPreview %>
				<% end_loop %>
			</ul>
			<h3 style="text-align:right;"><a href="{$Link}all">See all Photos <i class="icon-right-circled"></i></a></h3>
		</div>
		<% end_if %>

		<% if HideForSale %><% else %>
		<div class="subsection vehicles-for-sale">
			<h2 class="blockheading" id="projects"><a href="vehicles-for-sale?Category=$ID">Vehicles for sale</a></h2>
			<ul class="small-block-grid-3 large-block-grid-6 blockgrid">
				<% loop ForSaleProjects %>
					<% include ProjectPreview %>
				<% end_loop %>
			</ul>
			<h3 style="text-align:right;"><a href="vehicles-for-sale?Category=$ID">See all vehicles for sale <i class="icon-right-circled"></i></a></h3>
		</div>
		<% end_if %>

		<% if HideColors %><% else %>
			<% include Colors %>
		<% end_if %>


	</div>
</div>
