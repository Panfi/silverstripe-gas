<% include Heading %>

<div class="row">
	<div class="large-12 columns">
		<% if Categories %>
		<ul class="quicklinks overlayheading small-block-grid-2 large-block-grid-3">
			<% loop Categories %>
			<li>
				<div class="inner">
				<a href="$Link"><img src="mysite/images/loader.gif" data-src="<% with Image %>$CroppedImage(400,300).URL<% end_with %>" />
				<h3 class="blockheading">$Title <% include AddThisShare %></h3>
				</a>
				</div>
			</li>
			<% end_loop %>
		</ul>
		<% end_if %>
	</div>
</div>
<div class="row">
	<div class="large-12 columns">
		<% include SocialBlock %>

		<br/>
		<br/>
	</div>
</div>		
		
<!-- <div class="row layout">
	<div class="large-12 columns">		

		$Image.SetWidth(1000,600)
		<h2 data-magellan-destination="start" id="start">$Title</h2>
		<% include ShareThis %>
		$Message
		<% if VideoEmbed %><div class="flex-video widescreen">$VideoEmbed.RAW</div><% end_if %>
		$Content
		$CustomHtml.RAW
		$Form
		<% include Images %>
		<% include Comments %>
				
	</div>

</div> -->