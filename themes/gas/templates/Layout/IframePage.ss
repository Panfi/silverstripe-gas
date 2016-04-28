<% include Heading %>
<% include Images %>

<% if $FullWidth %>
	$Content
	<iframe src="$IframeURL" class="iframeContent" style="min-height: {$IframeHeight}px;"></iframe>
<% else %>

	<div class="row layout">
		<div class="large-12 columns">

			$Image.SetWidth(1000,600)

			<iframe src="$IframeURL" class="iframeContent" style="min-height: {$IframeHeight}px;"></iframe>

			$Message
			<% if VideoEmbed %><div class="flex-video widescreen">$VideoEmbed.RAW</div><% end_if %>
			<% if Content %>
				<div class="textcontent">$Content</div>
			<% end_if %>
			$CustomHtml.RAW
			$Form
			<% include Images %>
			<% include Comments %>

		</div>

	</div>

<% end_if %>
