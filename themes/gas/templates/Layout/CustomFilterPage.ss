<link href="mysite/jquery-selectbox/css/jquery.selectbox.css" type="text/css" rel="stylesheet" />


<% include Images %>

<div class="heading">
<div class="row">
	<div class="large-12 columns">
		<% if FilterType=="ForSale" %>
			<div class="row">
				<div class="large-8 columns">
					<h1 class="white">$Title <small><a href="#" class="expand-button">Advanced filter<i class="icon-angle-circled-down"></i></a></small></h1>
				</div>
				<div class="large-4 columns">
					<span class="white sharetext">Share this page</span>
					<% include AddThisButtons %>
				</div>
			</div>
			
			<div class="expand four" >
				$Form
				<!-- <div class="customaction"><a href="#" class="form_submit" ><b>UPDATE</b> <i class='icon-cw'></i></a></div> -->
			</div>
		
		<% else_if FilterType=="PickYourRide" %>
			<div class="row">
				<div class="large-8 columns">
					<h1 class="white">$Title</h1>
				</div>
				<div class="large-4 columns">
					<span class="white sharetext">Share this page</span>
					<% include AddThisButtons %>
				</div>
			</div>
			<div class="expand two" >
				$Form
				<!-- <div class="customaction"><a href="#" class="form_submit" ><b>UPDATE</b> <i class='icon-cw'></i></a></div> -->
			</div>
			
		
		<% end_if %>
		
	</div>
</div>
</div>

<% if Content %>
<div class="row">
	<div class="large-12 columns">
		<div class="textcontent">$Content</div>
		<hr />
	</div>
</div>
<% end_if %>

<div class="row">
	<div class="large-12 columns">
		<% if Projects %>
			<ul class="small-block-grid-2 large-block-grid-3 blockgrid results">
				<% loop Projects %>
				<% include ProjectPreviewSale %>
				<% end_loop %>
			</ul>
		<% else %>
			<ul class="small-block-grid-2 large-block-grid-3 blockgrid results"></ul>
			<div class="startselect"><h4>Photo gallery search.</h4>
			<p>Please select your search criteria.</p>
			</div>
		<% end_if %>
		<p><a id="loadmore" href="#loadmore" class="button loadmore radius expand" >Load more</a></p>
	</div>
</div>

<script type="text/javascript" src="mysite/jquery-selectbox/js/jquery.selectbox-0.2.js"></script>
<script type="text/javascript">
	var pageobject = $("#Form_FilterForm_p");
	var page = parseInt(pageobject.val());
	var postData = new Object();
	if(parseInt(pageobject.val()) > 0) { page = parseInt(pageobject.val()); }
	$("#Form_FilterForm").submit(function(e)
	{
	    //$(this).serializeArray();
	    postData.p = page;
	    var formURL = "{$Link}";
	    $.ajax(
	    {
	        url : formURL,
	        type: "GET",
	        data : postData,
	        success:function(data, textStatus, jqXHR) 
	        {
	            if(data!="") {
	            	l = $(data).children().length;
	            	if(page == 0) {
	            		$(".results").empty().html(data);
	            	}
	            	else {
	            		$(".results").append(data);
	            	}
	            	if(l==12) {
		            	$(".loadmore").attr("disabled",false).removeClass("disabled").fadeIn();
		            }
		            else {
		            	$(".loadmore").attr("disabled","disabled").addClass("disabled").fadeOut();
		            }
	            }
		        else {
		        	if(page==0) {
		        		message = "<hr/><h3>No galleries found.</h3><p>Please expand your search criteria.</p>";
		        		$(".results").html(message);
		        	}
		        	else {
		        		message = "<hr/><h3>No more galleries found.</h3><p>You may search again.</p>";
		        		$(".results").append(message);
		        	}
		        	$(".loadmore").attr("disabled","disabled").addClass("disabled").fadeOut();
		        }
		        $("img").unveil(300);
		        $(".loader").css("opacity",0);
	        },
	        error: function(jqXHR, textStatus, errorThrown) 
	        {
	            //if fails      
	        }
	    });
	    e.preventDefault(); //STOP default action
	});
	
	$(".loadmore").click(function() {
		console.log(page);
		page++;
		submitForm();
	});
	 
	function submitForm() {
		$(".loader").css("opacity",1);
		$(".startselect").hide();
		$("#Form_FilterForm").submit();	
	}
	$(function () {
		<% if FilterType=="ForSale" %>
			$("select").selectbox({
				onChange: function (val, inst) {
					postData[$(inst.input).attr("name")] = val;
					page=0;
					submitForm();
				}
			});
		<% else_if FilterType=="PickYourRide" %>
			$("#Form_FilterForm_Make").selectbox({
				onChange: function (val, inst) {
					postData.Make = val;
					page=0;
					$("#Form_FilterForm_Model").val(0);
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
							}
						});
					}
				}
			});
			$("#Form_FilterForm_Model").attr("disabled","disabled").selectbox({
				onChange: function (val, inst) {
					postData.Model = val;
					page=0;
					submitForm();
				}
			});
		<% end_if %>
	});
</script>