<div class="row">
	<div class="large-4 columns">
		<div class="sectionbox">
		<% if LinkOne %><a href="$LinkOne" title="$TitleOne"><% end_if %>
			$ImageOne.CroppedImage(400,225)
		<% if LinkOne %></a><% end_if %>
		<% if TitleOne %><h4>$TitleOne</h4><% end_if %>
		<% if ContentOne %><p>$ContentOne.RAW</p><% end_if %>
		<% if LinkOne %><a href="$LinkOne" class="button radius" title="$TitleTwo">View more</a><% end_if %>
		</div>
	</div>
	<div class="large-4 columns">
		<div class="sectionbox">
		<% if LinkOne %><a href="$LinkTwo" title="$TitleTwo"><% end_if %>
		$ImageTwo.CroppedImage(400,225)
		<% if LinkTwo %></a><% end_if %>
		<% if TitleTwo %><h4>$TitleTwo</h4><% end_if %>
		<% if ContentTwo %><p>$ContentTwo.RAW</p><% end_if %>
		<% if LinkTwo %><a href="$LinkTwo" class="button radius" title="$TitleTwo">View more</a><% end_if %>
		</div>
	</div>
	<div class="large-4 columns">
		<div class="sectionbox">
		<% if LinkThree %><a href="$LinkThree" title="$TitleThree"><% end_if %>
		$ImageThree.CroppedImage(400,225)
		<% if LinkThree %></a><% end_if %>
		<% if TitleThree %><h4>$TitleThree</h4><% end_if %>
		<% if ContentThree %><p>$ContentThree.RAW</p><% end_if %>
		<% if LinkOne %><a href="$LinkThree" class="button radius" title="$TitleThree">View more</a><% end_if %>
		</div>
	</div>
</div>
