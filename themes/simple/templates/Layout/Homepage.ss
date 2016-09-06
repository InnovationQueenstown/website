<div class="main" role="main">
	<div class="inner typography line">
		$Layout
		<table width = "100%">
			<tr>
				<th>Event</th>
				<th>Time</th>
			</tr>
			<% loop getMeetupData %>
				<tr>
					<td>$name</td>
					<td>$time</td>
				</tr>
			<% end_loop %>
		</table>
		<iframe src="mysite/code/mailchimpform.html" height="600" width="100%"></iframe>
	</div>
</div>