<div class="row">
	<div class="large-6 columns">
		<div class="sectionbox">
		<% if LinkOne %><a href="$LinkOne" title="$TitleOne"><% end_if %>
			$ImageOne.CroppedImage(600,337)
		<% if LinkOne %></a><% end_if %>
		<% if TitleOne %><h4>$TitleOne</h4><% end_if %>
		<% if ContentOne %><p>$ContentOne.RAW</p><% end_if %>
		<% if LinkOne %><a href="$LinkOne" class="button radius" title="$TitleTwo">View more</a><% end_if %>
		</div>
	</div>
	<div class="large-6 columns">
		<div class="sectionbox">
		<% if LinkOne %><a href="$LinkTwo" title="$TitleTwo"><% end_if %>
		$ImageTwo.CroppedImage(600,337)
		<% if LinkTwo %></a><% end_if %>
		<% if TitleTwo %><h4>$TitleTwo</h4><% end_if %>
		<% if ContentTwo %><p>$ContentTwo.RAW</p><% end_if %>
		<% if LinkTwo %><a href="$LinkTwo" class="button radius" title="$TitleTwo">View more</a><% end_if %>
		</div>
	</div>
</div>
