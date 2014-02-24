<script type="text/javascript" src="mysite/timelinejs/compiled/js/storyjs-embed.js"></script>

<% include Heading %>
<% include Images %>

<div class="row layout">
	<div class="large-12 columns">		

		$Image.SetWidth(1000,600)
		
		<% include ShareThis %>
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

<% include SocialBlock %>


<script>
   <% uncached 'timeline_source', Aggregate(TimelinePage).Max(LastEdited) %>
   var dataSource = {
       "timeline":
       {
           headline:"$Title",
           type:"default",
           text:"$Content",
           asset: {
               media:"<% if Image %><% control Image %>$SetHeight(500).URL<% end_control %><% end_if %>",
//               "credit":"Credit Name Goes Here",
 //              "caption":"Caption text goes here"
           },
           debug: true,
           "date": [
       		<% control Blogroll('Created ASC') %>
       			{
       			    startDate:"<% control Created %>$format(Y),$format(m),$format(d)<% end_control %>",
       			    headline:"$Title",
       			    text:"<% control Content %>$Summary.JS<% end_control %> <p><a href='$Link'>View article</a></p>",
       			    classname:"timeline-project",
       			    asset: {
       			        media:"<% if YouTubeID %> http://www.youtube.com/watch?v=$YouTubeID<% else_if FirstImage %><% control FirstImage %>$SetHeight(500).URL <% end_control %><% end_if %>",
       			        <% if FirstImage %>"thumbnail":"<% control FirstImage %>$CroppedImage(40,40).URL<% end_control %>",<% end_if %>
//           			        credit:"$Credit",
//           			        caption:"$Caption"
       			    }
       			}<% if Last %><% else %>,<% end_if %><% end_control %>
           ]
       }
   }
   <% end_cached %>

   createStoryJS({
       type:       'timeline',
       width:      '100%',
       height:     '500',
       embed_id:   'my-timeline',
       start_at_end: true,
       source: dataSource,
       css: 'mysite/timelinejs/compiled/css/timeline.css',
       js: 'mysite/timelinejs/compiled/js/timeline-min.js'
   });
</script>