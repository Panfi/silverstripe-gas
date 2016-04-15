<!-- SOCIAL STREAM -->

<% uncached 'socialstream' %>
<div class="socialstream">

	<div class="row">
	<div class="large-12 columns">

		<div class="row">
			<div class="large-6 columns">
				<h3><a href="https://www.facebook.com/GalpinAutoSports" target='_blank'><i class="icon-facebook-circled"></i> Follow us on <strong>Facebook</strong></a></h3>

					<% loop FacebookPosts %>
						<div class="post facebook p-10">
							<a href="$link" target="_blank">
								<div class="row">
									<div class="small-3 medium-2 columns">
										<div class="imagewrap" style="background-image: url($picture);">
											<img src="$ThemeDir/images/_blank-400x400.png" />
										</div>
									</div>
									<div class="small-9 medium-8 columns">
										$message
									</div>
								</div>
							</a>
						</div>
					<% end_loop %>
			</div>
			<div class="large-6 columns">
				<h3><a href="https://twitter.com/galpinautosport" target="_blank"><i class="icon-twitter-circled"></i> Follow us on <strong>Twitter</strong></a></h3>
				<%-- <div class="post twitter"> --%>
				<a class="twitter-timeline" href="https://twitter.com/galpinautosport" data-widget-id="721066395249696768" data-chrome="noheader nofooter noscrollbar transparent" data-tweet-limit="3">Tweets by @galpinautosport</a>
				<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
				<%-- </div> --%>
			</div>
		</div>

		<h3><a href="http://instagram.com/galpinautosports" target="_blank"><i class="icon-instagram-circled"></i> Follow us on <strong>Instagram</strong></a></h3>
		<!-- <ul class="large-block-grid-5 small-block-grid-3 blockgrid">
			< % loop Instagram % >
			<li class="$ClassName">
				<a href="$Link" target="_blank"><img src="$ImageURL" />
				 <i class="socialicon"></i>
				</a>
			</li>
			< % end_loop % >
		</ul> -->
		<div class="flex-video snapwidget">
				<% include SnapWidget %>
		</div>

	</div>
	</div>

</div>
<% end_cached %>
