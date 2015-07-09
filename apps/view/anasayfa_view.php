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
	?>
	<form action="<?php echo clk::site(); ?>/redirect" method="post">
		<input type="hidden" name="sayfa" value="arama" />
		<input type="text" name="sda" value="aaa" /><br />
		<input type="text" name="dsa" value="bbb" /><br />
		<input type="submit" value="Gönder" />
	</form>
</body>
</html>