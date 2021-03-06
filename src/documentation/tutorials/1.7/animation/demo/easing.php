<!DOCTYPE HTML>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>Demo: Animation Easing</title>
		<link rel="stylesheet" href="style.css" media="screen">
		<link rel="stylesheet" href="../../../resources/style/demo.css" media="screen">
	</head>
	<body>
		<h1>Demo: Animation Easing</h1>

		<button id="dropButton">Drop block</button>
		<button id="ariseSirButton">Return block</button>

		<div id="anim8target" class="box" style="top: 0; left: 50%; background-color: #fc9">
			<div class="innerBox">A box</div>
		</div>
		<?php
			include_once($_SERVER['DOCUMENT_ROOT'] . implode('/', array_slice(explode('/', dirname($_SERVER['PHP_SELF'])), 0, 4)) . '/Utils.php');
			Utils::printDojoScript();
		?>
		<script>
		
			require(["dojo/_base/fx", "dojo/fx/easing", "dojo/window", "dojo/on", "dojo/dom", "dojo/domReady!"], function(baseFx, easing, win, on, dom) {
				var dropButton = dom.byId("dropButton"),
					ariseSirButton = dom.byId("ariseSirButton"),
					anim8target = dom.byId("anim8target");

				// Set up a couple of click handlers to run our animations
				on(dropButton, "click", function(evt){
					// get the dimensions of our viewport
					var viewport = win.getBox(win.doc);
					baseFx.animateProperty({
						// use the bounceOut easing routine to have the box accelerate
						// and then bounce back a little before stopping
				        easing: easing.bounceOut,
				        duration: 500,
						node: anim8target,
						properties: {
							// calculate the 'floor'
							// and subtract the height of the node to get the distance from top we need
							top: { start: 0, end:viewport.h - anim8target.offsetHeight }
						}
					}).play();
				});
				on(ariseSirButton, "click", function(evt){
					baseFx.animateProperty({
						node: anim8target,
						properties: { top: 0 }
					}).play();
				});
			});
		
		</script>
	</body>
</html>
