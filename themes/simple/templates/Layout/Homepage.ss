<div class="content-container unit size3of4 lastUnit">
	<article>
		<h1>$Title</h1>
		<div class="content">$Content</div>
		<table width = "100%">
			<tr>
				<th>Event</th>
				<th>Time</th>
				<th>RSVP Count</th>
				<th>Event Link</th>
			</tr>
			<% loop getMeetupData %>
				<tr>
					<td>$name</td>
					<td>$time</td>
					<td>$rsvp</td>
					<td>$link</td>
				</tr>
			<% end_loop %>
		</table>
		<iframe src="mysite/code/mailchimpform.html" height="600" width="100%"></iframe>
	</article>
</div>
	