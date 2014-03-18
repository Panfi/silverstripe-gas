<% include Heading %>
<% include Images %>

<div class="row layout">
	<div class="large-12 columns">		

		$Image.SetWidth(1000,600)
		$Message
		<% if VideoEmbed %><div class="flex-video widescreen">$VideoEmbed.RAW</div><% end_if %>
		$Content
		<% if Profiles %>
		<ul class="large-block-grid-3 blockgrid">
		<% loop Profiles %>
			<li class="profile">
				<a href="#" data-image="$Image.SetWidth(400,400).URL" data-title="$Title" data-text="$Text" data-email="$Email" data-phone="$Phone" data-jobposition ="$JobPosition" >
					$Image.CroppedImage(400,400)
					<h3>$Title</h4>
					<% if JobPosition %><small class="label radius jobposition">$JobPosition</small><% end_if %>
				</a>
			</li>
		<% end_loop %>
		</li>
		<% end_if %>
		$CustomHtml.RAW
		$Form
		<% include Images %>
		<% include Comments %>
				
	</div>

</div>

<div id="profileModal" class="reveal-modal x-large" data-reveal>
	<div class="row">
		<div class="large-4 columns">
			<img src="" class="profilePic" />
		</div>
		<div class="large-8 columns">
			<div class="details">
				<h3 class="title"></h3>
				<p>
					<span class="label radius jobposition"></span>
				</p>
				<p>
					<i class="icon-phone"></i> <span class="phone"></span>
					<span class="divider"></span>
					<a class="email" href=""><i class="icon-mail-alt"></i> <span>E-mail</span></a>
				</p>
				<p class="text"></p>
			</div>
		</div>
	</div>
    
  <a class="close-reveal-modal">&#215;</a>
</div>