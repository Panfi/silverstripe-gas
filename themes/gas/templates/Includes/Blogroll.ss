<script src="$ThemeDir/blocksit/blocksit.min.js"></script>

<div class="loader"><img src="$ThemeDir/images/loader.gif" /></div>
<div class="blocks">
	<% loop Blogroll %>
	<div class="article $Blogroll.URLSegment">
		<% if VideoEmbed %><div class="flex-video widescreen">$VideoEmbed.RAW</div><% else %>
			<% if FirstImage %><center><a href="$Link">$FirstImage.SetWidth(500)</center><% end_if %>
		<% end_if %>
		<div class="details">
			<a href="$Link">
			<h3>$Title</h3>
			<% if Content %><p class="summary">$Content.Summary(30)</p><% end_if %>
			</a>
		</div>
	</div>
	<% end_loop %>
</div>

<script type="text/javascript">
$(document).ready(function() {
	$(".blocks").hide();
	$(window).load(function() {
		$(".loader").hide();
		$(".blocks").fadeIn('medium');
		if($(window).width()>768) { $('.blocks').BlocksIt({ numOfCol: 2 }); }
	});
});
</script>