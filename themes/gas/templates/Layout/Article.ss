<div class="heading">
	<div class="row">
		<div class="large-12 columns">
			<% with Item.Blogroll %><h1 class="white"><a href="$Link" title="Back to blog"><i class="icon-angle-circled-left"></i></a>$Title</h1><% end_with %>
		</div>
	</div>
</div>

<div class="row layout">

	<div class="large-3 columns push-9">
		<% include Sidebar %>
	</div>
	<div class="large-9 columns pull-3">
		<% include ArticleImages %>
		<% if Item.VideoEmbed %>
		<div class="player">
			<div class="flex-video widescreen"><% with Item %>$VideoEmbed.RAW<% end_with %></div>
		</div>
		<% end_if %>
		<div class="maincontent panel <% if Images %>hasimages<% end_if %>">
			<h2>$Title</h2>
			$Message
			<% if Content %>
				<div class="textcontent">$Content</div>
			<% end_if %>
			$CustomHtml.RAW
			<small>Published: <strong>$Created.Date</strong></small>
			$Form
		</div>
		
		<% include Comments %>
		
	</div>

</div>