<!-- SOCIAL STREAM -->		

<% uncached 'socialstream' %>
<div class="socialstream">

	<div class="row">
	<div class="large-12 columns">
			
		<div class="row">
			<div class="large-6 columns">
				<h3><a href="https://www.facebook.com/GalpinAutoSports" target='_blank'><i class="icon-facebook-circled"></i> Follow us on <strong>Facebook</strong></a></h3>
				<div class="post facebook">
					<% with FacebookPost %>
					$Content
					<% end_with %>
				</div>
			</div>
			<div class="large-6 columns">
				<h3><a href="https://twitter.com/galpinautosport" target="_blank"><i class="icon-twitter-circled"></i> Follow us on <strong>Twitter</strong></a></h3>
				<div class="post twitter">
				<% loop Twitter %>
					<a href="$Link" target="_blank">
						<% if ImageURL %><img src="$ImageURL" alt="Twitter_Thumbnail "/><% end_if %>
						$Content
					</a>
				<% end_loop %>
				</div>
			</div>
		</div>
		
		<h3><a href="http://instagram.com/galpinautosports" target="_blank"><i class="icon-instagram-circled"></i> Follow us on <strong>Instagram</strong></a></h3>
		<ul class="large-block-grid-5 small-block-grid-3 blockgrid">
			<% loop Instagram %>
			<li class="$ClassName">
				<a href="$Link" target="_blank"><img src="$ImageURL" />
				 <i class="socialicon"></i>
				</a>
			</li>
			<% end_loop %>
		</ul>
	
	</div>
	</div>

</div>
<% end_cached %>