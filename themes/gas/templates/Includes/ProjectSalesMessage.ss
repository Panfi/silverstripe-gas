<div class="salesmessage">
	<% if ForSale && not Sold %>
		<h3>Interested in purchasing this vehicle?</h3>
		<p>Contact our sales expert and make it yours.</p>
		<a href="mailto:info@galpinautosports.com?subject=Purchase of '$Title'&body=I was visiting the website of $Title at $AbsoluteLink \nI am interested in more information." class="button radius small theme-primary">E-mail our sales expert</a>
	<% else %>
		<h3>Interested in doing similar work to your vehicle?</h3>
		<p>Let our sales expert show you what we can do.</p>
		<a href="mailto:info@galpinautosports.com?subject=Interested in '$Title'&body=I was visiting the website of $Title at $AbsoluteLink \nI am interested in having similar work done to my vehicle. Please contact me with more information." class="button radius small theme-primary">E-mail our sales expert</a>
	<% end_if %>
</div>
