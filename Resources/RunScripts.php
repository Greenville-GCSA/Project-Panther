<?php

echo '
<!DOCTYPE html>
<html>
	<head>
		<title>Run Scripts</title>
		<meta charset="utf-8" />
		<link href="http://fonts.googleapis.com/css?family=Englebert" rel="stylesheet" type="text/css">
		<style>
			body { background: #e4e4e4; }
			h1, h4 { text-align: center; font-family: "Englebert", sans-serif; }
			h1 { font-size: 64pt; margin: 45px auto 0 auto; color: #999; text-shadow: 3px 3px 3px #555; }
			h4 { font-size: 32pt; margin: -15px auto 0 auto; color: #555; text-shadow: 3px 3px 3px #999; }
			ul#actions { margin: 10px auto 0 auto; display: block; text-align: center; list-style-type: none; font-family: "Englebert", sans-serif; font-size: 25pt; color: #555; }
			ul#actions li { padding-top: 10px; }
			ul#actions li:nth-child(even) { float: left; }
			ul#actions li:nth-child(odd) { float: right; margin-right: 48px; border-left: 4px dotted #999; padding-left: 69px; }
			ul#actions li:hover { color: #999; cursor: pointer; }
			br.clear { clear: both; }
			div.top-line { border-bottom: 4px dotted #999; margin: 0 auto 10px auto; }
			div.bottom-line { border-top: 4px dotted #999; margin: 10px auto 0 auto; }
			div#wrapper { width: 53%; margin: 0 auto 0 auto; }
			div#header { width: 58%; margin: 0 auto 0 auto; }
			.light_grey { color: #999 !important; }
			.dark_grey { color: #555 !important; }
		</style>
	</head>
	<body>
		<div id="header">
			<h1>GCSA Mobile - Developer Scripts</h1>
			<h4>What would you like to do?</h4>
		</div>
		<div id="wrapper">
			<div class="top-line"></div>
			<ul id="actions">
				<li id="update_compile_nav">Update and Compile Navigation</li>
				<li id="convert_array_to_json">Convert PHP Array to JSON Object</li>
			</ul>
			<br class="clear" />
			<div class="bottom-line"></div>
		</div>
	</body>
</html>
';