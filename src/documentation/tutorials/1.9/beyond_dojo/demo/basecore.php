<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Demo: Dojo Base / Dojo Core</title>
	</title>
	<link rel="stylesheet" href="../../../resources/style/demo.css" media="screen" type="text/css">
	<?php
		include_once($_SERVER['DOCUMENT_ROOT'] . implode('/', array_slice(explode('/', dirname($_SERVER['PHP_SELF'])), 0, 4)) . '/Utils.php');
		Utils::printClaroCss();
	?>
	<link rel="stylesheet" href="style.css" media="screen" type="text/css">
</head>
<body class="claro">
	<a name="top" class="topLink" style="position: absolute; top: 0"></a>
	<h1 id="mainHeading">Demo: Dojo Base / Dojo Core</h1>
	
	<h3>Dojo Base</h3>
	<div>
		<label for="dojoQuery">Find heading elements using <code>dojo/query</code> and add "back to top" links to each</label>
		<button id="dojoQuery" name="dojoQuery" type="button">Add 'back to top' links</button>
	</div>

	<h3>Dojo Core Example: Date Comparison</h3>
	<div>
		<label for="dojoDate">Days since the millenium: </label><span id="outDate"></span>
		<button id="dojoDate" name="dojoDate" type="button">Calculate dates</button>
	</div>

	<?php
		include_once($_SERVER['DOCUMENT_ROOT'] . implode('/', array_slice(explode('/', dirname($_SERVER['PHP_SELF'])), 0, 4)) . '/Utils.php');
		Utils::printDojoScript("async: true");
	?>
	<script>
		require([
			"dojo/date",
			"dojo/dom",
			"dojo/query",
			"dojo/_base/array",
			"dojo/dom-construct",
			"dojo/on",
			"dojo/domReady!"
		], function(date, dom, query, array, domConst, on){
			function daysSince(fromDate, target){
				// summary:
				// 	dojo Core example to calculate difference in days since the given date

				if(!(fromDate instanceof Date)){
					fromDate = new Date(fromDate);
				}
				console.log("from date: ", fromDate);
				var now = new Date();
				console.log("From Date: " + fromDate.toUTCString()); // note that even toUTCString output is implementation-dependent

				console.log("Difference in days: " + date.difference(fromDate, now, "day"));

				// dojo/date provides a number of handy methods for working with dates
				// here we use the difference method, and ask for the result in 'day' units
				var days  = date.difference(fromDate, now, "day");

				dom.byId(target).innerHTML = days;
			}

			function topLinks(){
				// summary:
				// 	dojo Base example to add 'top' links before each heading

				// query can take just about any valid CSS3 selector
				var headings = query('h2,h3');

				// array.forEach provides iteration over collections
				array.forEach(headings, function(elm){
					// domConst.create is a convenience for creating DOM elements
					var topLink = domConst.create("a", {
						href: "#top",
						innerHTML: "^top"
					});

					// domConst.place lets to insert (or move) an element in the DOM
					domConst.place(topLink, elm, "before");
				});
			}

			// Now let's connect the click events of our buttons to their functions.
			on(dom.byId("dojoQuery"), "click", topLinks);
			on(dom.byId("dojoDate"), "click", function(){
				daysSince("January 1, 2000 00:00:00", "outDate");
			});
		});
	</script>
</body>
</html>
