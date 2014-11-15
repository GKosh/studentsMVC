<?php
/**
* Default layout 
* layout.php
* 
* Layout use variables provided by controller and output header, content and footer in html format 
*
*
* @vertion 1.0
* @author G.Kosh
*/
?>


<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title><?php

echo $title;
?></title>
<link rel="stylesheet" type="text/css" href="<?= $CSS; ?>" media="all">
<?php foreach ($JavaScript as $script=>$filename): ?>
	<script type="text/javascript" src="<?= (\app::getURL() . 'data/js/' . $filename) ?>"></script>
<?php endforeach; ?>
</head>
<body id="main_body" >

	<?php if (file_exists($header_path)) include $header_path; ?>
	<?php if (file_exists($content_path)) include $content_path; ?>
	<?php if (file_exists($footer_path)) include $footer_path; ?>
	

</body>
</html>


