<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<title>Colak MVC Yükleyici</title>
	<link rel="stylesheet" href="css/reset.css" type="text/css" />
	<link rel="stylesheet" href="css/style.css" type="text/css" />
</head>
<body>
	<div id="genel">
		<header>
			<menu>
				<ul>
					<li><a href="?id=1">Kurulum</a></li>
					<li><a href="?id=2">Yardım</a></li>
					<li><a href="?id=3">Hakkında</a></li>
				</ul>
			</menu>
			<a class="baslik" href="index.php">
				colakMVC v1.0
			</a>
		</header>
		<section>
			<?php
				$id=@$_GET["id"];
				if($id==""){
				?>
					<p class="karsilama">colakMVC ye Hoşgeldiniz.</p>
				<?php
				}
				elseif($id==1){
					if(@file_exists(__DIR__."/lock.lock")){
					?>
					<p class="hata">Kurulum Yapabilmek İçin <font class="linki">"<?php echo __DIR__; ?>/lock.lock"</font> dosyasını silmelisiniz!</p>
					<?php
					}
					else{
					if($_POST){
						function bulDegistir($bul,$degistir,$yazi){
							$yeni="";
							for($i=0;$i<strlen($yazi);$i++){
								if($bul==substr($yazi,$i,strlen($bul))){
									$i+=strlen($bul)-1;
									$yeni=$yeni.$degistir;
								}
								else{
									$yeni=$yeni.$yazi[$i];
								}
							}
							return $yeni;
						}
						$vtSite=@$_POST["vtSite"];
						$vtKadi=@$_POST["vtKadi"];
						$vtSifre=@$_POST["vtSifre"];
						$vtAdi=@$_POST["vtAdi"];
						$doc=bulDegistir(file_get_contents("tersSlash.txt"),"/",__DIR__);
						$doc=rtrim($doc,"/");
						$doc=$doc."/";
						$siteLink=@$_POST["siteLink"];
						$siteLink=rtrim($siteLink,"/");
						$siteLink=$siteLink."/";
						if($vtSite=="" || $vtKadi=="" || $vtAdi=="" || $siteLink==""){
						?>
						<p class="uyari">Boş Alan Bırakmayın</p>
						<?php
						}
						else{
							$dosya=fopen("../config.php","w");
							fputs($dosya,'<?php
	$mysql=array();
	$mysql["site"]="'.$vtSite.'";
	$mysql["kadi"]="'.$vtKadi.'";
	$mysql["sifre"]="'.$vtSifre.'";
	$mysql["db"]="'.$vtAdi.'";
	$data["doc"]="'.$doc.'";
	$data["site"]="'.$siteLink.'";
?>');
							fclose($dosya);
							fopen("lock.lock","w");
							header("Location:?id=2");
						}
					}
					?>
						<form action="" method="post">
							<table class="kurulumTablo">
								<tr>
									<td align="right">Veritabanı Site:</td><td align="left"><input type="text" name="vtSite" /></td>
								</tr>
								<tr>
									<td align="right">Veritabanı Kullanıcı Adı:</td><td align="left"><input type="text" name="vtKadi" /></td>
								</tr>
								<tr>
									<td align="right">Veritabanı Şifre:</td><td align="left"><input type="text" name="vtSifre" /></td>
								</tr>
								<tr>
									<td align="right">Veritabanı Adı:</td><td align="left"><input type="text" name="vtAdi" /></td>
								</tr>
								<tr>
									<td align="right">Site Link:</td><td align="left"><input type="text" name="siteLink" /></td>
								</tr>
								<tr>
									<td align="right"></td><td align="right"><input type="submit" value="Kaydet" /></td>
								</tr>
							</table>
						</form>
					<?php
					}
				}
				elseif($id==2){
				?>
				<div class="konular">
					<ul>
						<li><a href="#">Giriş</a></li>
						<li><a href="#">Controller</a></li>
						<li><a href="#">Model</a></li>
						<li><a href="#">View</a></li>
					</ul>
				</div>
				<?php
				}
			?>
		</section>
		<footer>
			
		</footer>
	</div>
</body>
</html>