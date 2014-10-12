<% with Item %>   
<div class="heading carbon">
    <div class="row">
      <div class="large-8 columns">
        <h1 class="white" ><a href="$Brand.Link">$Brand.Image.CroppedImage(150,150)</a></h1>
      </div>
      <div class="large-4 columns">
        <span class="white sharetext">Share this page</span>
        <% include AddThisButtons %>
      </div>
    </div>
  </div>

<div class="row layout">

  <div class="large-12 columns">
    
    <!-- <h1 class="white">$Title</h1> -->
    
    
    
    <div class="row">
      <div class="large-6 columns">
          <% if Images %>
            <% if ImageCount==1 %>
              <img src="$Image.PaddedImage(800,800).URL" alt="<% if Caption %>$Caption<% else %>Image-$Pos<% end_if %>" />
            <% else %>
              <div class="slideshow-wrapper leading">
                <div class="preloader"></div>
                <ul data-orbit data-options="pause_on_hover:true; resume_on_mouseout:true; slide_number:false;bullets:false; animation:'fade'; animation_speed: 1000;">
                  <% loop Images %>
                  <li>
                    <% if Link %><a href="$Link"><% end_if %>
                    <img src="$Image.PaddedImage(800,800).URL" alt="<% if Caption %>$Caption<% else %>Image-$Pos<% end_if %>" data-interchange="[$Image.PaddedImage(1000,1000).URL, (default)], [$Image.PaddedImage(500,500).URL, (small)]"/>
                  </li>
                  <% end_loop %>
                </ul>
              </div>
            <% end_if %>
            <% end_if %>
      </div>
      <div class="large-6 columns">
        <h2>$Title</h2>
        <% with Brand %><p><a href="$Item.Brand.Link"><img src="$Image.CroppedImage(50,50).URL" alt="$Title.XML" /> $Title</a></p><% end_with %>
        <h3>$Price.Nice</h3>
        <div class="textcontent moretext">$Content</div>
        <hr />

          <div class="dropdown-wrap">
            <a href="#" data-dropdown="drop1" class="button radius expand">Related categories</a>
            <ul id="drop1" class="f-dropdown" data-dropdown-content>
              <li><a href="categories">All categories</a></li>
              <% loop Categories %>
                <li><a href="$Link">$Image.CroppedImage(40,40) $Title</a></li>
              <% end_loop %>
            </ul>
          </div>

          <div class="dropdown-wrap">
            <a href="#" data-dropdown="drop3" class="button radius expand">Related brands</a>
            <ul id="drop3" class="f-dropdown" data-dropdown-content>
              <li><a href="brands">All our brands</a></li>
              <% loop Brands %>
                <li><a href="$Link">$Image.CroppedImage(40,40) $Title</a></li>
              <% end_loop %>
            </ul>
          </div>

        </div>
      </div>
    </div>


    <h2>Found in these Vehicles</h2>
    <div class="section-container auto gassection" data-section>
      <% if Projects %>
      <section class="section active">
        <p class="title" data-section-title><a href="#panel1">Vehicles</a></p>
        <div class="content" data-section-content>
           <ul class="small-block-grid-3 large-block-grid-6 blockgrid">
            <% loop Projects %>
            <% include ProjectPreview %>
            <% end_loop %>
           </ul>
           <h4><a href="">See all our <strong>Vehicles</strong> <i class="icon-right-circled"></i></a></h4>
        </div>
      </section>
      <% end_if %>
      <% if Categories %>
      <section class="section">
        <p class="title" data-section-title><a href="#panel2">What we do</a></p>
        <div class="content" data-section-content>
           <ul class="small-block-grid-3 large-block-grid-6 blockgrid">
            <% loop Categories %>
            <li><a href="$Link" title="$Title.XML"><img src="mysite/images/loader.gif" data-src="<% if Image %><% with Image %>$CroppedImage(200,200).URL<% end_with %><% else %>http://placehold.it/200x200&text=No+image<% end_if %>" /></a></li>
            <% end_loop %>
           </ul>
           <h4><a href="/what-we-do">See all <strong>What We Do</strong> <i class="icon-right-circled"></i></a></h4>
        </div>
      </section>
      <% end_if %>
      <% if SimilarProducts %>
      <section class="section">
        <p class="title" data-section-title><a href="#panel3">Related products</a></p>
        <div class="content" data-section-content>
           <ul class="small-block-grid-3 large-block-grid-6 blockgrid">
            <% loop SimilarProducts %>
            <li><a href="$Link" title="$Title.XML"><img src="mysite/images/loader.gif" data-src="<% if Image %><% with Image %>$CroppedImage(200,200).URL<% end_with %><% else %>http://placehold.it/200x200&text=No+image<% end_if %>" /></a></li>
            <% end_loop %>
           </ul>
           <h4><a href="/what-we-do">See all <strong>What We Do</strong> <i class="icon-right-circled"></i></a></h4>
        </div>
      </section>
      <% end_if %>
    </div>
    
    <!-- <% if Brands %>
    <div class="projectbrands">
    <h3 class="blockheading"><a href="#">Brands</a></h3>
    <ul class="overlayheading large-block-grid-6 small-block-grid-3 blockgrid">
      < % control Brands % >
        <li>
          <a href="$Link" title="View '$Title' brand details" class="th radius"><img src="mysite/images/loader-light.png" data-src="< % control Image % >$WhitePaddedImage(150,150).URL< % end _ control % >" alt="$Title" /></a>
        </li> 
      < % end _ control % >
    </ul>
    </div>
    <% end_if %> -->

    <% end_with %>

</div>
</div>

    