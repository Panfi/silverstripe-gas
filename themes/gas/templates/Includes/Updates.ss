<!-- UPDATES -->

	<div class="hsection updates">
		<div class="row">
			<div class="large-4 columns">
				<h3 class="blockheading"><a href="blog">News</a></h3>
				<% loop RecentNews(3) %>
				<article>
					<a href="$Link">
					<img src="mysite/images/loader.png" data-src="$ThumbnailURL(400)" />
					<h4>$Title <i class="icon-angle-circled-right"></i></h4>
					</a>
				</article>
				<% end_loop %>
			</div>
			<div class="large-4 columns">
				<h3 class="blockheading"><a href="events">Upcoming Events</a></h3>
				<% loop RecentEvents %>
					<a href="$Link">
					<img src="mysite/images/loader.png" data-src="$ThumbnailURL(400)" />
					<h4>$Title <i class="icon-angle-circled-right"></i></h4>
					</a>
				<% end_loop %>
			</div>
			<div class="large-4 columns">
				<h3 class="blockheading"><a href="specials">Specials</a></h3>
					<% loop RecentSpecials(5) %>
					<div class="panel">
					       <a href="$Link">
					       <img src="mysite/images/loader.png" data-src="<% with Image %>$CroppedImage(400,250).URL<% end_with %>" />
					         <h4>$Title</h4>
					       </a>
					 </div>
					<% end_loop %>
			</div>
		</div>
	</div>		