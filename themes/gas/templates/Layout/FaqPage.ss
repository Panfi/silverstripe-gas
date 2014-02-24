<% include Heading %>
<% include Images %>

<div class="row layout">
	<div class="large-12 columns">		

		$Image.SetWidth(1000,600)
		
		<div class="section-container accordion" data-section="accordion">
		<% loop Questions %>
			  <section class="<% if Pos==1 %>active<% end_if %>">
			    <p class="title" data-section-title><a href="#"><strong style="text-transform:uppercase;">$Question</strong></a></p>
			    <div class="content" data-section-content>
			      <p>$Answer.</p>
			    </div>
			  </section>
		<% end_loop %>
		</div>
		
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