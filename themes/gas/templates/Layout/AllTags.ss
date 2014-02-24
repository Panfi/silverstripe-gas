<% include Heading %>

<% if Tags %>
	<div class="row">
	<div class="large-12">
		<br/>
		<h3>
			<center>
			<% loop Tags %>
				<span class="radius label"><a href="$Link" title="View '$Title' tags">$Title</a></span> &nbsp;
			<% end_loop %>
			</center>
		</h3>
	</div>
	</div>
<% end_if %>

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
		$Message
		<% if VideoEmbed %><div class="flex-video widescreen">$VideoEmbed.RAW</div><% end_if %>
		$Content
		$CustomHtml.RAW
		$Form
		<% include Images %>
		<% include Comments %>
				
	</div>

</div> -->