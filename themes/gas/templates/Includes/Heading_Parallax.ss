<% if ActionText %>
	<div class="saleswrap theme-primary-underscore" <% if Image %>style="background: #000 url(<% with Image %>$SetWidth(1000).URL<% end_with %>) no-repeat center center fixed;"<% end_if %> >
		<div class="row">
			<div class="large-6 columns">
				<h1 class="white">$Title</h1>
			</div>
			<div class="large-6 columns">
				<div class="salesmessage">
					$ActionText
					<% if ActionButtonLabel %><a href=<% if ActionButtonLink %>"$ActionButtonLink"<% else %>"#" data-reveal-id="contactModal"<% end_if %> class="button radius small theme-primary"><% if ActionButtonLabel %>$ActionButtonLabel<% else %>E-mail our expert<% end_if %></a>
					<% end_if %>
					<% include AddThisButtons %>
				</div>
			</div>
		</div>
	</div>
	<script>
		$(".saleswrap").hide();
		h = $( window ).height() - 185;
		$(".saleswrap").height(h);
		
		$(document).ready(function() {
			$(".saleswrap").show();
		});
	</script>
<% else %>
	<div class="heading">
		<div class="row">
			<div class="large-8 columns">
				<h1 class="white">$Title</h1>
			</div>
			<div class="large-4 columns">
				<span class="white sharetext">Share this page</span>
				<% include AddThisButtons %>
			</div>
		</div>
	</div>
<% end_if %>