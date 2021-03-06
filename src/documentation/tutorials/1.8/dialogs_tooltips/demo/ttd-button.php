<!DOCTYPE HTML>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>Demo: Button Dropdown</title>
		<?php
    		include_once($_SERVER['DOCUMENT_ROOT'] . implode('/', array_slice(explode('/', dirname($_SERVER['PHP_SELF'])), 0, 4)) . '/Utils.php');
    		Utils::printClaroCss();
    	?>
		<link rel="stylesheet" href="../../../resources/style/demo.css" media="screen">
	</head>
	<body class="claro">
		<h1>Demo: Button Dropdown</h1>
		<p>Please log into your account.</p>
		<div data-dojo-type="dijit/form/DropDownButton">
			<span>Login</span><!-- Text for the button -->
			<!-- The dialog portion -->
			<div data-dojo-type="dijit/TooltipDialog" id="ttDialog">
				<strong><label for="email" style="display:inline-block;width:100px;">Email:</label></strong>
				<div data-dojo-type="dijit/form/TextBox" id="email"></div>
				<br />
				<strong><label for="pass" style="display:inline-block;width:100px;">Password:</label></strong>
				<div data-dojo-type="dijit/form/TextBox" id="pass"></div>
				<br />
				<button data-dojo-type="dijit/form/Button" data-dojo-props="onClick:doAlert" type="submit">Submit</button>
			</div>
		</div>

		<!-- load dojo and provide config via data attribute -->
		<?php
			include_once($_SERVER['DOCUMENT_ROOT'] . implode('/', array_slice(explode('/', dirname($_SERVER['PHP_SELF'])), 0, 4)) . '/Utils.php');
			Utils::printDojoScript();
		?>
		<script>
			// Require the Button, TooltipDialog, DropDownButton, and TextBox classes
			require(["dojo/parser", "dojo/ready", "dijit/form/Button", "dijit/form/DropDownButton", "dijit/TooltipDialog", "dijit/form/TextBox"],
			function(parser, ready){
				// Alerter
				ready(function(){
					parser.parse();
				});
			});
			function doAlert() {
				alert('Logging in!');
			}
		</script>
	</body>
</html>
