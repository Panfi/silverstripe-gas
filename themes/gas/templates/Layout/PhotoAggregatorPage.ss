<div class="heading">
<div class="row">
	<div class="large-12 columns">
	
		<div class="row">
			<div class="large-8 columns">
				<h1 class="white">$Title <small><a href="#" class="expand-button">Advanced filter<i class="icon-angle-circled-down"></i></a></small></h1>
			</div>
			<div class="large-4 columns">
				<span class="white sharetext">Share this page</span>
				<% include AddThisButtons %>
			</div>
		</div>
		
		<div class="expand five" >
			<% cached 'searchform', Aggregate(Category).Max(LastEdited) %>
				$Form
			<% uncached %>
		</div>
		
	</div>
</div>
</div>

<div class="row layout">

	<div class="large-12 columns">
		
		$Content
		
		<% if Photos %>
			<ul class="large-block-grid-3 small-block-grid-2 blocks results" id="photos">
				<% loop Photos %>
				<li class="item">
					<a href="$Large" data-sharelink="$Link" data-projectlink="$Project.Link" data-projecttitle="$Project.Title" class="photo" data-imagelink="$AbsoluteLink">$Image.SetWidth(400)</a>
				</li>
				<% end_loop %>
			</ul>
		<% else %>
			<ul class="large-block-grid-3 small-block-grid-2 blocks results"></ul>
			<div class="startselect"><h4>Photo gallery search.</h4>
			<p>Please select your search criteria.</p>
			</div>
		<% end_if %>
		<p><a id="loadmore" href="#loadmore" class="button loadmore radius expand" >Load more</a></p>
		
		<link href="mysite/jquery-selectbox/css/jquery.selectbox.css" type="text/css" rel="stylesheet" />
		<link rel="stylesheet" href="mysite/magnific//dist/magnific-popup.css"> 
		<script src="mysite/js/masonry.js"></script>
		<script src="mysite/magnific/dist/jquery.magnific-popup.js"></script>
		<script type="text/javascript" src="mysite/jquery-selectbox/js/jquery.selectbox-0.2.js"></script>
		<script type="text/javascript">
		
			\$(function(){
				var pageobject = \$("#Form_FilterForm_p");
				var page = parseInt(pageobject.val());
				var postData = new Object();
				if(parseInt(pageobject.val()) > 0) { page = parseInt(pageobject.val()); }
				
				\$(".normalSelect select").selectbox({
					onChange: function (val, inst) {
						postData[\$(inst.input).attr("name")] = val;
						page=0;
						submitForm();
					}
				});
				
				\$("#Form_FilterForm_Make").selectbox({
					onChange: function (val, inst) {
						postData.Make = val;
						page=0;
						\$("#Form_FilterForm_Model").val(0);
						if(val>0) {
							$.ajax({
								type: "GET",
								data: {make: val},
								url: "{$Link}getmodels",
								success: function (data) {
									console.log(data);
									$("#Form_FilterForm_Model_Holder .middleColumn").empty().html(data);
									$("#Form_FilterForm_Model").attr("disabled",false).selectbox({
										onChange: function (val, inst) {
											page=0;
											postData.Model = val;
											submitForm();
										}
									});
									postData.Model = 0;
									submitForm();
								}
							});
						}
						else {
							postData.Model = 0;
							$("#Form_FilterForm_Model").attr("disabled","disabled")
							submitForm();
						}
					}
				});
				
				\$("#Form_FilterForm_Model").attr("disabled","disabled").selectbox({
					onChange: function (val, inst) {
						postData.Model = val;
						page=0;
						submitForm();
					}
				});
				
				function redoPhotos() {
				
					buildWall();
				
					\$(".blocks .photo").magnificPopup({
						gallery: {
						  enabled: true
						},
						type: 'image', 
						image: {
							titleSrc: function(item) {
							  title = "Check out this image of " + item.el.attr("data-projecttitle") + " from Galpin Auto Sport. ";
							  myurl = item.el.attr("data-imagelink");
							  return '  <a href="' + item.el.attr("data-projectlink") + '" title="View entire photo gallery" class="projectlink"><strong>' + item.el.attr("data-projecttitle") + '</strong> - View all <i class=" icon-angle-circled-right"></i></a> '+
							  	'<span class="addthis_toolbox addthisproject addthis_default_style " addthis:url="'+myurl+'">'+
							  	    '<a class="addthis_button_facebook"></a>'+
							  	    '<a class="addthis_button_twitter"></a>'+
							  	    '<a class="addthis_button_google"></a>'+
							  	    '<a class="addthis_button_email"></a>'+
							  	    '<a class="addthis_button_compact"></a>'+
							  	'</span>'
							  ;
							}
						},
						verticalFit: true,
						tError: '<a href="%url%">The image</a> could not be loaded.',
						callbacks: {
						    elementParse: function(item) {
						      addthis.toolbox(".addthisproject");
						    }
						  }
					});
				
				}
				
				\$("#Form_FilterForm").submit(function(e)
				{
				    postData.p = page;
				    var formURL = "{$Link}";
				    \$.ajax(
				    {
				        url : formURL,
				        type: "GET",
				        data : postData,
				        success:function(data, textStatus, jqXHR) 
				        {
				            if(data!="") {
				            	items = \$(data).children();
				            	l = items.length;
				            	if(page == 0) {
				            		\$container.empty();
//				            		container.html(items);
				            	}
//				            	else {
//				            		container.append(items);
//				            	}
				            	\$container.append(data);
				            	\$container.masonry('reloadItems');
				            	if(l==12) {
					            	\$(".loadmore").attr("disabled",false).removeClass("disabled").fadeIn();
					            }
					            else {
					            	\$(".loadmore").attr("disabled","disabled").addClass("disabled").fadeOut();
					            }
				            }
					        else {
					        	if(page==0) {
					        		message = "<hr/><h3>No photos found.</h3><p>Please expand your search criteria.</p>";
					        		\$(".results").html(message);
					        	}
					        	else {
					        		message = "<hr/><h3>No more photos found.</h3><p>You may search again.</p>";
					        		\$(".results").append(message);
					        	}
					        	\$(".loadmore").attr("disabled","disabled").addClass("disabled").fadeOut();
					        }
					        redoPhotos();
					        // \$("img").unveil(300);
					        \$(".loader").css("opacity",0);
				        },
				        error: function(jqXHR, textStatus, errorThrown) 
				        {
				            //if fails      
				        }
				    });
				    e.preventDefault(); //STOP default action
				});
				
				\$(".loadmore").click(function(e) {
					e.preventDefault();
					console.log(page);
					page++;
					submitForm();
				});
				 
				function submitForm() {
					\$(".loader").css("opacity",1);
					\$(".startselect").hide();
					\$("#Form_FilterForm").submit();	
				}
				
				var \$container = \$('#photos'); 
				function buildWall() {
			        // \$container.css("opacity", 0);
			        \$container.imagesLoaded(function(){
			          // \$container.delay(1000).animate({ opacity: 1 });
			          \$container.masonry({
			            columnWidth: '.item',
			            gutterWidth:0, 
			            isAnimated : true,
			            isResizeBound: true,
			            itemSelector : '.item'
			          });
			        }); 
			    }
			    buildWall();
				
			});
			
		</script>
			
			<% include AddThis %>
		</div>
	</div>
</div>