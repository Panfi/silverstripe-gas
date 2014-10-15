<% with Item %>   
<div class="heading carbon">
    <div class="row">
      <div class="large-8 columns">
        <h1 class="white" ><a href="$Brand.Link">$Brand.Image.CroppedImage(60,60) $Brand.Title</a></h1>
      </div>
      <div class="large-4 columns">
        <span class="white sharetext">Share this page</span>
        <% include AddThisButtons %>
      </div>
    </div>
  </div>

<div class="whitebg">
  <div class="row layout">
    <div class="large-12 columns">
      
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
                    <li data-orbit-slide="image-{$Pos}">
                      <% if Link %><a href="$Link"><% end_if %>
                      <img src="$Image.PaddedImage(800,800).URL" alt="<% if Caption %>$Caption<% else %>Image-$Pos<% end_if %>" data-interchange="[$Image.PaddedImage(1000,1000).URL, (default)], [$Image.PaddedImage(500,500).URL, (small)]"/>
                    </li>
                    <% end_loop %>
                  </ul>
                  <ul class="small-block-grid-6 product-thumbs">
                    <% loop Images %>
                      <li>
                        <a data-orbit-link="image={$Pos}">$Image.CroppedImage(80,80)</a>
                      </li>
                    <% end_loop %>
                  </ul>
                </div>
              <% end_if %>
              <% end_if %>
        </div>
        <div class="large-6 columns">

          <div class="leftpad">
            <h2>$Title</h2>
            <!-- <% with Brand %><p><a href="$Item.Brand.Link"><img src="$Image.CroppedImage(50,50).URL" alt="$Title.XML" /> $Title</a></p><% end_with %> -->
            <% if AvailableSizses %>
              <p class="additional">Available sizes: <strong>$AvailableSizes</strong></p>
            <% end_if %>
            <% if Price %>
              <h3>$Price.Nice</h3>
            <% end_if %>
            <div class="textcontent moretext">$Content</div>
            <hr />
            <h3>Interested in <strong>$Title</strong>?</h3>
            <p>
              <a href="#" data-dropdown="drop1" class="button radius"><strong>Click here</strong> to find out more</a>
              or 
              <a href="#" data-dropdown="drop3" class="button radius"><strong>Click here</strong> to Call us</a>
            </p>
          </div>

        </div>
      </div>

      <% if Projects %>
      <h2>Found in these Vehicles</h2>
      <ul class="small-block-grid-3 large-block-grid-6 blockgrid">
            <% loop Projects %>
            <% include ProjectPreview %>
            <% end_loop %>
           </ul>
           <h4><a href="">See all our <strong>Vehicles</strong> <i class="icon-right-circled"></i></a></h4>
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
  </div>
</div>
<% end_with %>