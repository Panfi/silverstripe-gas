<aside class="left-off-canvas-menu">
  <ul class="off-canvas-list block scrollable">
    <li><label>Site map</label></li>
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
    <li>
        <a href="brands">Our brands</a>
    </li>
  </ul>
</aside>

<aside class="right-off-canvas-menu">
  <ul class="off-canvas-list block scrollable">
    <li><label>News & updates</label></li>
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
</aside>