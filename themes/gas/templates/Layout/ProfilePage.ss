<% include Heading %>
<% include Images %>

<div class="row layout">
	<div class="large-12 columns">		

		$Image.SetWidth(1000,600)
		$Message
		<% if VideoEmbed %><div class="flex-video widescreen">$VideoEmbed.RAW</div><% end_if %>
		$Content
		<% if Profiles %>
		<% loop Profiles %>
			<div class="profile">
				<h3>$Title</h3>
				<div class="row">
					<div class="small-4 columns">
						$Image.SetWidth(400)
					</div>
					<div class="small-8 columns">
						<% if JobPosition %><small>$JobPosition</small><% end_if %>
						$Text
						<% if VideoEmbed %>
							<div class="flex-video widescreen">
								$VideoEmbed.RAW
							</div>
						<% end_if %>
					</div>
				</div>
			</div>
		<% end_loop %>
		<% end_if %>
		$CustomHtml.RAW
		$Form
		<% include Images %>
		<% include Comments %>
				
	</div>

</div>
