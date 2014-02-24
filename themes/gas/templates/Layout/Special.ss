<div class="heading">
	<div class="row">
		<div class="large-8 columns">
			<h1 class="white"><a href="specials" title="Back to specials"><i class="icon-angle-circled-left"></i></a>$Title</h1>
		</div>
		<div class="large-4 columns">
			<span class="white sharetext">Share this page</span>
			<% include AddThisButtons %>
		</div>
	</div>
</div>

<div class="row layout">

	<div class="large-3 columns push-9">
		<% include Sidebar %>
	</div>
	<div class="large-9 columns pull-3">
		$Image.SetWidth(900)
		<div class="maincontent panel <% if Images %>hasimages<% end_if %>">
			<h2>$Title</h2>
			<% if Content %>
				<div class="textcontent">$Content</div>
			<% end_if %>
			<small>Published: <strong>$Created.Date</strong></small>
			$Form
		</div>
		
		<% include Comments %>
		
	</div>

</div>