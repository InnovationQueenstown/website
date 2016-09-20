<div class="content-container unit size3of4 lastUnit">
	<article>
		<div class="content">$Content</div>
			<h2>Upcoming events</h2>
			<% loop getMeetupData %>
				<a href=$link>
					<div class="MUOuter">
						<h2>$name</h2>
						
						<p class="MUTime">$time</p>
						<br>
						<p class="MURSVP">RSVPs: $rsvp</p>
						
						
						<p class="MULoc">$loc</p>
						<img class="MUImage" src="themes/simple/images/Meetup.png"/>
						<div class="MUClear"></div>
					</div>
				</a>
			<% end_loop %>
			<br>
			<hr>
			<h2 >Subscribe to our mailing list</h2>
		<iframe src="mysite/code/mailchimpform.html" height="600" width="100%"></iframe>
	</article>
</div>
	