﻿<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
	<meta http-equiv="X-UA-Compatible" />
	<title>BOOMCHICKAPOP® Boom Tour™</title>
    
	<!-- Allow fullscreen mode on iOS devices. (These are Apple specific meta tags.) -->
	<meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no, target-densitydpi=device-dpi" />
	<meta name="apple-mobile-web-app-capable" content="yes" />
	<meta name="apple-mobile-web-app-status-bar-style" content="black" />
	<meta name="HandheldFriendly" content="true" />
    
	<link rel="shortcut icon" href="../wp-content/uploads/2014/08/Boomtour_favicon-2.ico" type="image/x-icon" />

    <!-- All margins and padding must be zero for the canvas to fill the screen. -->
	<style type="text/css">
		* {
			padding: 0;
			margin: 0;
		}
		body {
			background: #9ad9e9;
			color: #fff;
			overflow: hidden;
			font-family:Arial;
		}
		.close{
			position:absolute;
			right:20px;
			margin: 10px 20px;
			font-weight:bold;
			font-size: 42px;
			cursor:pointer;
		}

    </style>
	

</head> 
 
<body>
	<div id="fb-root"></div>
	
	<!-- The canvas must be inside a div called c2canvasdiv -->
	<div id="c2canvasdiv">
	
		<!-- The canvas the project will render to.  If you change its ID, don't forget to change the
		ID the runtime looks for in the jQuery events above (ready() and cr_sizeCanvas()). -->
		<canvas id="c2canvas" width="320" height="480">
			<!-- This text is displayed if the visitor's browser does not support HTML5.
			You can change it, but it is a good idea to link to a description of a browser
			and provide some links to download some popular HTML5-compatible browsers. -->
			<h1>Your browser does not appear to support HTML5.  Try upgrading your browser to the latest version.  <a href="http://www.whatbrowser.org">What is a browser?</a>
			<br/><br/><a href="http://www.microsoft.com/windows/internet-explorer/default.aspx">Microsoft Internet Explorer</a><br/>
			<a href="http://www.mozilla.com/firefox/">Mozilla Firefox</a><br/>
			<a href="http://www.google.com/chrome/">Google Chrome</a><br/>
			<a href="http://www.apple.com/safari/download/">Apple Safari</a><br/>
			<a href="http://www.google.com/chromeframe">Google Chrome Frame for Internet Explorer</a><br/></h1>
		</canvas>
		
	</div>
	
	<!-- Pages load faster with scripts at the bottom -->
	
	<!-- Construct 2 exported games require jQuery. -->
	<script src="jquery-2.0.0.min.js"></script>


	
    <!-- The runtime script.  You can rename it, but don't forget to rename the reference here as well.
    This file will have been minified and obfuscated if you enabled "Minify script" during export. -->
	<script src="c2runtime.js"></script>

    <script>
		// Size the canvas to fill the browser viewport.
		jQuery(window).resize(function() {
			cr_sizeCanvas(jQuery(window).width(), jQuery(window).height());
		});
		
		// Start the Construct 2 project running on window load.
		jQuery(document).ready(function ()
		{			
			// Create new runtime using the c2canvas
			cr_createRuntime("c2canvas");
			$(".close").click(function(){
				window.open('','_self').close();
			});
		});
		
		// Pause and resume on page becoming visible/invisible
		function onVisibilityChanged() {
			if (document.hidden || document.mozHidden || document.webkitHidden || document.msHidden)
				cr_setSuspended(true);
			else
				cr_setSuspended(false);
		};
		
		document.addEventListener("visibilitychange", onVisibilityChanged, false);
		document.addEventListener("mozvisibilitychange", onVisibilityChanged, false);
		document.addEventListener("webkitvisibilitychange", onVisibilityChanged, false);
		document.addEventListener("msvisibilitychange", onVisibilityChanged, false);
		
    </script>
</body> 
</html> 