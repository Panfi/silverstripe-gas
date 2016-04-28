<% if ActionEnabled %>
	<div class="saleswrap theme-primary-underscore heading" <% if ActionImage %>style="background: #000 url($ActionImage.CroppedImage(1200,600).URL) no-repeat center center; background-size: cover;"<% end_if %> >
		<div class="row">
			<div class="large-6 columns">
				<div class="vertical-align-parent mh-280">
					<div class="vertical-align vertical-align-absolute">
						<% if ClassName=="Category" %>
							<h1 class="white">$Title</h1>
							<% if ActionButtonLabel %>
								<div>
									<a href=<% if ActionButtonLink %>"$ActionButtonLink"<% else %>"#" data-reveal-id="contactModal"<% end_if %> class="button radius small theme-primary"><% if ActionButtonLabel %>$ActionButtonLabel<% else %>E-mail our expert<% end_if %></a>
								</div>
							<% end_if %>
						<% else %>
							<h1 class="white">$Title</h1>
						<% end_if %>
					</div>
				</div>
			</div>
		</div>
	</div>
<% else %>
	<div class="heading">
		<div class="row">
			<div class="large-8 columns">
				<h1 class="white">$Title</h1>
				<% if ActionButtonLabel %><a href=<% if ActionButtonLink %>"$ActionButtonLink"<% else %>"#" data-reveal-id="contactModal"<% end_if %> class="button radius small theme-primary"><% if ActionButtonLabel %>$ActionButtonLabel<% else %>E-mail our expert<% end_if %></a>
				<% end_if %>
			</div>
			<div class="large-4 columns">
				<span class="white sharetext">Share this page</span>
				<% include AddThisButtons %>
			</div>
		</div>
	</div>
<% end_if %>
