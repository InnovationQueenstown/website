<div class="content-container unit size3of4 lastUnit">
	<article>
		<h1>$Title</h1>
		<div class="content">$Content</div>
			<% loop getMeetupData %>
				<a href=$link>
					<div class="MUOuter">
						<h2>$name</h2>
						<p class="MUTime">$time</p>
						<br>
						<p class="MURSVP">RSVPs: $rsvp</p>
						<div class="MUClear"></div>
					</div>
				</a>
			<% end_loop %>
		<iframe src="mysite/code/mailchimpform.html" height="600" width="100%"></iframe>
	</article>
</div>
	