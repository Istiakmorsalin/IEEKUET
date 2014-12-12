<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
	<head>
		<title>Mega Grid - XML Flash Gallery</title>
        <meta name="Keywords" content="mega grid, xml flash gallery, resizable, draggable thumbnails, horizontal scrollbar, fluid layout, 100% width height, AS3, flashmo" />
        <meta name="Description" content="Mega Grid - free flash AS3 XML gallery in a fluid layout. Features include randomly scaled thumbnails, completely filled up, draggable and horizontal scrollbar." />
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
        <style type="text/css">
        <!--
        html, body { height: 100%; }
		body {
            margin: 0;
            padding: 0;
			overflow: hidden;
            color: #FFF;
            background-color: #000;
            font-family: Georgia, "Times New Roman", Times, serif;
            font-size: 13px;
        }
        a:link, a:visited { color: #FFF; }
        a:hover { color: #FF0; }
        -->
        </style>

        <!-- embedding SWF -->
		<script type="text/javascript" src="swfobject.js"></script>
        <script type="text/javascript" src="swffit.js"></script>
		<script type="text/javascript">
			var flashvars = {};
			flashvars.xml_file = "flashmo_249_photo_list.xml";
			var params = {};
			params.allowfullscreen = true;
			var attributes = {};
			attributes.id = "flashmo_template";
			attributes.name = "flashmo_template";
			swfobject.embedSWF("flashmo_249_mega_grid.swf", "flashmo_template", "100%", "100%", "9.0.0", false, flashvars, params, attributes);
			swffit.fit("flashmo_template", 600, 600);
		</script>
        <!-- embedding SWF -->
	</head>
	<body>
		<!-- flash template SWF -->
			<div id="flashmo_template">
            	<br /><br />
            	<a href="http://www.flashmo.com" target="_parent">Free Flash Gallery</a><br /><br />
                <a href="http://www.adobe.com/go/getflashplayer">
                    <img src="http://www.adobe.com/images/shared/download_buttons/get_flash_player.gif" alt="Get Adobe Flash player" />
                </a>
			</div>
		<!-- flash template SWF --> 
	</body>
</html>