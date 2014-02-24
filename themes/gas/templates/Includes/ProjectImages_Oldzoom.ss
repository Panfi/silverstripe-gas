<% if Images %>
<% if ImageCount==1 %>
	<script>var largeurl = "$Image.CroppedImage(1600,1200).URL";</script>
	<a class="photo"><img src="$LeadingImageURL" alt="<% if Caption %>$Caption<% else %>Image-$Pos<% end_if %>" /></a>
<% else %>
	<div class="gallerywrap">
	<% loop Images %>
	<% if Pos==1 %>
		<script>var largeurl = "$Image.CroppedImage(1600,1200).URL";</script>
		<a class="photo"><img src="$Image.CroppedImage(1000,400).URL" alt="<% if Caption %>$Caption<% else %>Image-$Pos<% end_if %>" class="zoomimage" /></a>
		<ul class="large-block-grid-8 small-block-grid-4 blockgrid">
			<li><a data-small = "$Image.CroppedImage(1000,400).URL" data-large = "$Image.CroppedImage(1600,1200).URL" class="clicker"><img src="$Image.CroppedImage(240,160).URL" alt="<% if Caption %>$Caption<% else %>Image-$Pos<% end_if %>" /></a></li>
	<% else %>
		<li><a data-small = "$Image.CroppedImage(1000,400).URL" data-large = "$Image.CroppedImage(1600,1200).URL" class="clicker"><img src="$Image.CroppedImage(240,160).URL" alt="<% if Caption %>$Caption<% else %>Image-$Pos<% end_if %>" /></a></li>
	<% end_if %>
	<% end_loop %>
	</ul>
	</div>
<% end_if %>
<% end_if %>

<script>
	
	$(document).ready(function(){
	  $('a.photo').zoom({url: largeurl});
	  
	  $('.clicker').click(function() {
	  	$('.photo').trigger('zoom.destroy');
	  	url = $(this).data("small");
	  	large = $(this).data("large");
	  	$('.zoomimage').attr("src", url);
	  	$('a.photo').zoom({url: large});
	  })	  
	});
	
</script>

<style>
	.photo {
		display: block;
		overflow: hidden;
	}
	.fullscreen {
		position: relative;
		z-index: 10000;
		overflow: hidden;
		position: absolute; top: 0; right: 0; bottom: 0; left: 0;
		width: 100%;
		height: 100%;
	}
	.gallerywrap{
		background: #222;
		padding: 0.5em;
	}
</style>