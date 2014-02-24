<script type="text/javascript" src="mysite/timelinejs/compiled/js/storyjs-embed.js"></script>

<% include Heading %>
<% include Images %>

<div class="row layout timeline">
	<div class="large-12 columns">		

		$Image.SetWidth(1000,600)
		
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

<div id="my-timeline"></div>

<script>
   <% uncached 'timeline_source', Aggregate(TimelinePage).Max(LastEdited) %>
   var dataSource = {
       "timeline":
       {
           headline:"$Title",
           type:"default",
           text:"$Content",
           asset: {
               media:"<% with Image %>$SetHeight(500).URL<% end_with %>",
//               "credit":"Credit Name Goes Here",
 //              "caption":"Caption text goes here"
           },
           debug: true,
           "date": [
           <% if AggregateProjects %>
           		<% loop Projects %>
           			{
           			    startDate:"<% with Created %>$format(Y),$format(m),$format(d)<% end_with %>",
           			    headline:"$Title",
           			    text:"<% with Content %>$Summary.JS<% end_with %> <p><a href='$Link'>Click to view gallery</a></p>",
           			    classname:"timeline-project",
           			    asset: {
           			        media:"<% if FirstImage %><% with FirstImage %>$SetHeight(400).URL<% end_with %><% end_if %>",
           			        <% if FirstImage %>"thumbnail":"<% with FirstImage %>$CroppedImage(40,40).URL<% end_with %>",<% end_if %>
//           			        credit:"$Credit",
//           			        caption:"$Caption"
           			    }
           			}<% if Last %><% else %>,<% end_if %><% end_loop %>
           <% else %>
	           <% loop TimelineItems %>
	               {
	                   startDate:"<% with StartDate %>$format(Y),$format(m),$format(d)<% end_with %>",
	                   <% if EndDate %>"endDate":"<% with StartDate %>$format(Y),$format(n),$format(d)<% end_with %>",<% end_if %>
	                   headline:"$Headline",
	                   text:"$Text",
	                   classname:"timeline-entry $ExtraClass",
	                   asset: {
	                       media:"<% if Media %>$Media.RAW<% else_if Image %><% with Image %>$SetHeight(400).URL<% end_with %><% end_if %>",
	                       <% if Image %>"thumbnail":"<% with Image %>$CroppedImage(40,40).URL<% end_with %>",<% end_if %>
	                       credit:"$Credit",
	                       caption:"$Caption"
	                   }
	               }<% if Last %><% else %>,<% end_if %><% end_loop %>
	       <% end_if %>
           ]
       }
   }
   <% end_cached %>

   createStoryJS({
       type:       'timeline',
       width:      '100%',
       height:     '600',
       embed_id:   'my-timeline',
       source: dataSource,
       css: 'mysite/timelinejs/compiled/css/timeline.css',
       js: 'mysite/timelinejs/compiled/js/timeline-min.js'
   });
</script>