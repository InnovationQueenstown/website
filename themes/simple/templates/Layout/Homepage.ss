<div class="content-container unit size3of4 lastUnit">
	<article>
		<h1>$Title</h1>
		<div class="content">$Content</div>
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
		</table>ailchimpform.html
		<% include Mailchimp %>
	</article>
</div>
	