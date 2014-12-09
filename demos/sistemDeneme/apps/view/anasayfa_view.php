<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<title>Anasayfa</title>
	<link rel="canonical" href="<?php echo clk::canonical(); ?>" />
</head>
<body>
	<?php
		echo "Maker:".clk::maker."<br />";
		echo "Version:".clk::version."<br />";
		foreach($yazilar as $y){
			extract($y);
			echo $baslik."<br />";
		}
		echo clk::canonical();
	?>
</body>
</html>