<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
	<head>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<title>SEEAT</title>
		<link href="http://fonts.googleapis.com/css?family=Averia+Sans+Libre:300,400,700,300italic,400italic,700italic" rel="stylesheet" type="text/css" />
		<link href="style.css" rel="stylesheet" type="text/css" media="screen" />
	</head>
	<body>
		

		<div id="page">

			<div id="content">
				<?php

					if (is_file($_REQUEST[arquivo])) {
                                    include($_REQUEST[arquivo]);
                                } else {
                                    include("passoUm.php");
                                }
                                ?>

				<div style="clear: both;">&nbsp;</div>
			</div>
		</div>

		<div id="footer">
			
		</div>

	</body>
</html>
