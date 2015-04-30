<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>

</head>

<body>

<style>
	
	html { background-color: #f6f6f6; }
	* { padding: 0; margin: 0; }
	ul { width: 1200px; margin: auto; vertical-align: middle; }
	li { background-color: #fff; list-style-type: none; width: 60px; height: 60px; display: inline-block; zoom: 1; *display: inline; text-align: center; padding: 18px 0; box-sizing: border-box; box-shadow: inset 0 1px 0px 0px rgba(0, 0, 0, .1); border-radius: 50%; margin: 30px; font: normal normal 24px/24px Georgia, "Times New Roman", Times, serif; letter-spacing: .25px; color: #888; }
	li:nth-child(2n) { background-color: #eee; box-shadow: inset 0 -1px 0px 0px rgba(0, 0, 0, .1); }
	li:last-of-type { background: #0C0; color: #fff; }
	
</style>

<ul>

	<?php foreach (range(1, 500) as $number) {
    	echo '<li>' . $number . '</li>';
	} ?>

</ul>

</body>
</html>