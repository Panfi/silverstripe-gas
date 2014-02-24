<div class="hide-for-small minimenu">
	<div class="minimenu-inner">
		<a href="./"><i class="icon-home"></i> home </a> &nbsp;
		<a href="blog"><i class="icon-pencil"></i> blog </a> &nbsp;
		<a href="specials"><i class="icon-tags"></i> specials </a> &nbsp;
		<a data-reveal-id="contactModal" class="togglecenter">Contact us <i class="icon-phone-circled"></i></a>
		Follow us:
		<a href="https://www.facebook.com/GalpinAutoSports"><i class="icon-facebook-circled"></i></a>
		<a href="https://twitter.com/galpinautosport"><i class="icon-twitter-circled"></i></a>
		<a href="http://instagram.com/galpinautosports"><i class="icon-instagram-circled"></i></a>
		<a href="http://www.youtube.com/galpinautosports"><i class="icon-play-circled-1"></i></a>
	</div>
</div>

<nav id="nav1" role="navigation" class="sidenav sidenav-left">
    <div class="block scrollable" data-dy="0" >
    	<div>
        <h2 class="block-title">Site map</h2>
        <ul>
        	<% loop Menu(1) %>
        	<li>
        	    <a href="$Link">$Title</a>
        	</li>
	        	<% if Children %>
	        		<% loop Children %>
			        	<li class="sub">
			        	    <a href="$Link"><i class="icon-right-open-mini"></i> $MenuTitle</a>
			        	</li>
		        	<% end_loop %>
		        <% end_if %>
		    <% end_loop %>
            <!-- <li>
                <a href="#">Galpin Classics</a>
            </li>
            <li class="sub">
                <a href="#"><i class="icon-right-open-mini"></i> American</a>
            </li>
            <li class="sub">
                <a href="#"><i class="icon-right-open-mini"></i> European</a>
            </li>
            <li class="sub">
                <a href="#"><i class="icon-right-open-mini"></i> For Sale</a>
            </li>
            <li class="sub">
                <a href="#"><i class="icon-right-open-mini"></i> Classic Car Service</a>
            </li> -->
            <li>
                <a href="#">Our Brands</a>
            </li>
        </ul>
        </div>
    </div>
</nav>

<nav id="nav2" role="navigation" class="sidenav sidenav-right">
    <div class="block scrollable" data-dy="0" >
    	<div>
        <h2 class="block-title">News & Updates</h2>
        <ul>
        	<% loop RecentArticles(5) %>
        	<li>
        	       <a href="$Link">
        	      <img src="mysite/images/loader.png" data-src="$ThumbnailURL" />
        	       $Title
        	       </a>
        	   </li>
        	<% end_loop %>
			<li>
			       <a href="blog">
			         See all <strong>News and Updates</strong> <i class="icon-angle-circled-right"></i>
			       </a>
			   </li>
        </ul>
        </div>
    </div>
</nav>