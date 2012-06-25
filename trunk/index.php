<?php require $_SERVER['DOCUMENT_ROOT'] . "/resources/scripts/include.php"; ?>

<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<title>GT LoL</title>
	<?php gtInclude("includes/head.php"); ?>
	<style type="text/css">
		#left {
			float: left;
			width: 70%;
			clear: both;
		}
		
		#left-inner {
			padding:5px;
			margin:5px;
		}

		#right {
			float: right;
			width: 30%;
		}
		
		#right-inner {
			padding:5px;
			margin:5px;
		}

		#frontpagecal {
			padding: 5px;
			margin: 0px;
		}

		table{
			width: 90%;
		}

		td {
			text-align: right;
		}

		td.event, th {
			text-align: left;
		}

		#frontpagestreamers {
			height: 200px;
		}

		#frontpagestreamers ul {
			list-style-type: none;
			text-align: left;
		}
	</style>
</head>
<body>
<div id="main" class="primaryBGColor">
	<?php gtInclude("includes/top.php"); ?>
	<div id="left">
		<div id="left-inner" class="primaryFGColor">
			<div id="frontpagenews">
				<h2>latest news post</h2><br />
				<p>This is the latest news post. Show first x lines or text, then have a 'read more' link. If it is a small newspost, have a 'read more' link anyway('see all'?)</p>
			</div>
		</div>
	</div>
	<div id="right">
		<div id="right-inner" class="secondaryFGColor" >
			<div id="frontpagecal">
				<h2>Upcoming events:</h2>
				<p> Calendar stuff goes here - small list of events in next x hours for the user, or for all public events</p>
				<table>
					<tr><th colspan="2">today</th></tr>
					<tr>
						<td class="event">Event</td>
						<td>12</td>
					</tr>
					<tr>
						<td class="event">event two</td>
						<td>6pm</td>
					</tr>
					<tr><th colspan="2">tomorrow</th></tr>
					<tr>
						<td class="event">event three</td>
						<td>8am</td>
					</tr>
				</table>
			</div>
			<div id="frontpagestreamers">
				<h3>current streamers</h3>
				<p>a list of the current streamers online, each one has a link to its stream. autoupdating?</p>
				<ul>
					<li><a href="stream.html?streamid=1000">Streamer 1</a></li>
					<li><a href="stream.html?streamid=1001">Streamer 2</a></li>
					<li><a href="stream.html?streamid=1002">Streamer 3</a></li>
					<li><a href="stream.html?streamid=1003">Streamer 4</a></li>
					<li><a href="stream.html?streamid=1004">Streamer 5</a></li>
				</ul>
			</div>
		</div>
	</div>
	<div style="clear:both;"></div>
	<?php gtInclude("includes/foot.php"); ?>
</body>
</html>
