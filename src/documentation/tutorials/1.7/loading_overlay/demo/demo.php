<?php include_once($_SERVER['DOCUMENT_ROOT'] . implode('/', array_slice(explode('/',dirname($_SERVER['PHP_SELF'])), 0, 4)) . '/Utils.php') ?>
<!DOCTYPE HTML>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>Demo: Loading Overlay</title>
		<link rel="stylesheet" href="../../../resources/style/demo.css" media="screen">
		<link rel="stylesheet" href="style.css" media="screen">
		<link rel="stylesheet" href="layout.css" media="screen">
		<?php Utils::printClaroCss() ?>
		<?php /* For this demo, the script should be loaded and executed to avoid display of the HTML */
		Utils::printDojoScript("isDebug: true, async: true, parseOnLoad:true") ?>
</head>
<body class="claro">
	<div id="loadingOverlay" class="loadingOverlay pageOverlay"></div>
	<script>
		// demo is the object used to control the loading effects
		var demo;
		require(["dojo/dom-style", "dojo/_base/fx", "dojo/_base/declare", "dijit/registry", "dojo/dom"],
		function(domStyle, fx, declare, registry, dom){
			var Demo = declare(null,{
				overlayNode:null,

				// store a reference to the overlay node
				constructor:function(){
					this.overlayNode = dom.byId('loadingOverlay');
				},

				// called to hide the loading overlay
				endLoading: function()
				{
					// fade the overlay gracefully
					fx.fadeOut({
						node: this.overlayNode,
						onEnd: function(node){
							domStyle.set(node, 'display', 'none');
						}
					}).play();
				},

				// initialize the editor
				initEditor: function() {
					// if the editor hasn't been created, create it
					if(!registry.byId("edit")) {
						require(["dijit/Editor",
							"dijit/_editor/_Plugin",
							"dijit/_editor/plugins/AlwaysShowToolbar",
							"dijit/_editor/plugins/FontChoice",
							"dijit/_editor/plugins/TextColor",
							"dijit/_editor/plugins/LinkDialog"],function(Editor){
							registry.byId("tabs").addChild(new Editor({
								id: "edit",
								title: "Edit"
							}));
						});
					}
				}
			});
			demo = new Demo();
		});

		// require layout widgets
		require(["dojo/_base/lang", "dojo/domReady!",
			"dijit/layout/BorderContainer",
			"dijit/layout/TabContainer",
			"dijit/layout/ContentPane"],
		function(lang){
			// layout is ready, hide the loading overlay
			demo.endLoading();
			// initialize the editor, after a half-second delay for older browsers
			setTimeout(lang.hitch(demo, "initEditor"), 500);
			// page is ready to run
		});
	</script>
	<div id="appLayout" class="demoLayout" data-dojo-type="dijit.layout.BorderContainer" data-dojo-props="design: 'headline'">
		<div class="edgePanel" data-dojo-type="dijit.layout.ContentPane" data-dojo-props="region: 'top'">
			<h1>Demo: Loading Overlay</h1>
		</div>
		<div class="centerPanel" data-dojo-type="dijit.layout.TabContainer" id="tabs" data-dojo-props="region: 'center', tabPosition: 'bottom'">
			<div data-dojo-type="dijit.layout.ContentPane" data-dojo-props="title: 'Group 1'">
				<h4>Group 1 Content</h4>
				<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
			</div>
			<div data-dojo-type="dijit.layout.ContentPane" data-dojo-props="title: 'Group Two'">
				<h4>Group 2 Content</h4>
			</div>
			<div data-dojo-type="dijit.layout.ContentPane" data-dojo-props="title: 'Long Tab Label for this One'">
				<h4>Group 3 Content</h4>
			</div>
			<div id="edit" data-dojo-props="title: 'Edit'"></div>
		</div>
		<div id="leftCol" class="edgePanel" data-dojo-type="dijit.layout.ContentPane" data-dojo-props="region: 'left', splitter: true">Sidebar content (left)</div>
	</div>
</body>
</html>
