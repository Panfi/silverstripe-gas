<link href="mysite/zozotabs/css/zozo.tabs.min.css" rel="stylesheet" />

<% include Images %>

<!--- MAIN CATEGORIES --->

<div class="shaded hsection">
<div class="row">
	<div id="mainsections" class="section">
		<ul>
			<% loop FeaturedCategories %>
				<li><a>$Title</a></li>
			<% end_loop %>
		</ul>
		<div>
		<% loop FeaturedCategories %>
		
			<div>
				<% include MultiBlock %>
			</div>

		<% end_loop %>
		</div>
	</div>
</div>
</div>

<!--- CORPORATE BUILDS BLOCK --->

<div class="row">
	<div class="large-12 columns">
	
		<div class="b">
			<div class="row">
				<div class="large-12">
					<h2><a href="#">Our brands</a></h2>
					<ul class="overlayheading large-block-grid-9 small-block-grid-3 blockgrid">
						<% loop Brands %>
							<li>
								<a href="$Link" title="View '$Title' brand details"><img src="mysite/images/loader-light.png" data-src="<% with Image %>$WhitePaddedImage(150,150).URL<% end_with %>" alt="$Title" /></a>
							</li>	
						<% end_loop %>
					</ul>
					<h3 class="right-align"><a href="brands">View <strong>all our brands</strong> <i class="icon-angle-circled-right"></i></a></h3>
				</div>
			</div>
		</div>
	
		<div class="custombuilds sectionwrap">
		<% with Page(custom-builds) %>
		<!-- <h2 class="blockheading"><a href="$Link">$Title</a> <% include AddThisShare %></h2> -->
		<img src="$ThemeDir/images/custom_builds.jpg" />
		<div class="section-container auto gassection" data-section>
		  <% loop Children %>
		  <section class="section <% if Pos==1 %>active<% end_if %>">
		    <p class="title" data-section-title><a href="#panel{$Pos}">$Title</a></p>
		    <div class="content" data-section-content>
		     <% include MultiSlide %>
		     <h4><a href="$Link">See all Photo Galleries in <strong>$Title</strong> <i class="icon-right-circled"></i></a></h4>
		    </div>
		  </section>
		  <% end_loop %>
		</div>
		<% end_with %>
		</div>
		
		<div class="classics sectionwrap">
			<% with Page(classic-auto-service) %>
			<!-- <h2 class="blockheading"><a href="$Link">$Title</a> <% include AddThisShare %></h2> -->
			<img src="$ThemeDir/images/galpin_classics_copperplate_metal.jpg" />
			<div class="section-container auto gassection" data-section>
			  <% loop Children %>
			  <section class="section <% if Pos==1 %>active<% end_if %>">
			    <p class="title" data-section-title><a href="#panel{$Pos}">$Title</a></p>
			    <div class="content" data-section-content>
			     <% include MultiSlide %>
			     <h4><a href="$Link">See all Photo Galleries in <strong>$Title</strong> <i class="icon-right-circled"></i></a></h4>
			    </div>
			  </section>
			  <% end_loop %>
			</div>
			<% end_with %>
		</div>
		<div class="history">
			<a href="./our-history/interactive-timeline">
				<img src="mysite/images/loader-light.png" data-src="$ThemeDir/images/history.jpg" />
			</a>
		</div>
				
	</div>
</div>

<script>
    $(document).ready(function () {
        $("#mainsections").zozoTabs({
            rounded: false,
            animation: {
               duration: 800,
               effects: "slideH",
               type: "linear"
            },
            position: "top-center",
             responsive: false 
        });
    });
</script>

		
		
<!-- <div class="row layout">
	<div class="large-12 columns">		

		$Image.SetWidth(1000,600)
		<h2 data-magellan-destination="start" id="start">$Title</h2>
		$Message
		<% if VideoEmbed %><div class="flex-video widescreen">$VideoEmbed.RAW</div><% end_if %>
		$Content
		$CustomHtml.RAW
		$Form
		<% include Images %>
		<% include Comments %>
				
	</div>

</div> -->