<% include Heading %>
<% include Images %>

<div class="row layout">
	<div class="large-12 columns">		

		$Image.SetWidth(1000,600)
		$Message
		<% if VideoEmbed %><div class="flex-video widescreen">$VideoEmbed.RAW</div><% end_if %>
		$Content

		<% if Profiles %>
		<ul class="large-block-grid-4">
		<% loop Profiles %>
			<li>
				<div class="profile text-centered">
					<a href="#" class="profilepreview" data-text="$Text.ATT" data-title ="$Title" data-phone="$Phone" data-email="$Email" data-job="$JobPosition">
						<% if Image %>
							$Image.CroppedFromTopImage(400,400)
						<% else %>
							<img src="$ThemeDir/images/1x1-pixel.png" width="400" height="400" />
						<% end_if %>
						<h4>$Title</h4>
						<p>
						<% if JobPosition %><span class="label primary radius">$JobPosition</span><br/><% end_if %>
						<% if Phone %>$Phone<br/><% end_if %>
						<% if Email %><a href="mailto:{$Email}" title = "Email $Title">$Email<% end_if %>
						</p>
					</a>
				</div>
			</li>
		<% end_loop %>
		</ul>
		<% end_if %>

		$CustomHtml.RAW
		$Form
		<% include Images %>
		<% include Comments %>
				
	</div>

</div>
