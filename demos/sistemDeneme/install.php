<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
	<title>colak MVC</title>
</head>
<body>
	<center>
		<h1>colakMVC v1.0 kuruluma hoş geldiniz.</h1>.
		<a href="?islem=1">Kısa Kurulum</a>&nbsp;&nbsp;&nbsp;<a href="?islem=2">Yardım</a>&nbsp;&nbsp;&nbsp;<a href="?islem=3">Hakkında</a>
		<?php
			$islem=@$_GET["islem"];
			if($islem==""){}
			else if($islem==1){
				if($_POST){
					$link=$_POST["link"];
					$kadi=$_POST["kadi"];
					$sifre=$_POST["sifre"];
					$db=$_POST["db"];
					$dokuman=$_POST["dokuman"];
					if($link=="" || $kadi=="" || $db=="" || $dokuman==""){
					?>
						<h3><font color="red">Eksik değer göndermeyin.</font></h3>
					<?php
					}
					else{
						$config=fopen("config.php","w");
$cikti='<?php
	$mysql=array();
	$mysql["site"]="'.$link.'";
	$mysql["kadi"]="'.$kadi.'";
	$mysql["sifre"]="'.$sifre.'";
	$mysql["db"]="'.$db.'";
	$data["doc"]="'.$dokuman.'";
?>';
						fputs($config,$cikti);
						fclose($config);
						$htaccess=fopen(".htaccess","w");
$cikti='RewriteEngine On

RewriteCond %{REQUEST_FILENAME} !-d
RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-l

RewriteRule ^(.+)$ index.php?q=$1 [NC,L]

# Enable GZIP
<ifmodule mod_deflate.c>
	AddOutputFilterByType DEFLATE text/text text/html text/plain text/xml text/css application/x-javascript application/javascript
	BrowserMatch ^Mozilla/4 gzip-only-text/html
	BrowserMatch ^Mozilla/4\.0[678] no-gzip
	BrowserMatch \bMSIE !no-gzip !gzip-only-text/html
</ifmodule>
# Expires Headers - 2678400s = 31 days
<ifmodule mod_expires.c>
	ExpiresActive On
	ExpiresDefault "access plus 2678400 seconds"
	ExpiresByType text/html "access plus 7200 seconds"
	ExpiresByType image/gif "access plus 2678400 seconds"
	ExpiresByType image/jpeg "access plus 2678400 seconds"
	ExpiresByType image/png "access plus 2678400 seconds"
	ExpiresByType text/css "access plus 750000 seconds"
	ExpiresByType text/javascript "access plus 2678400 seconds"
	ExpiresByType application/x-javascript "access plus 2678400 seconds"
</ifmodule>
# Cache Headers
<ifmodule mod_headers.c>
	# Cache specified files for 31 days
	<filesmatch "\.(ico|flv|jpg|jpeg|png|gif|css|swf)$">
		Header set Cache-Control "max-age=2678400, public"
	</filesmatch>
	# Cache HTML files for a couple hours
	<filesmatch "\.(html|htm)$">
		Header set Cache-Control "max-age=7200, private, must-revalidate"
	</filesmatch>
	# Cache PDFs for a day
	<filesmatch "\.(pdf)$">
		Header set Cache-Control "max-age=86400, public"
	</filesmatch>
	# Cache Javascripts for 31 days
	<filesmatch "\.(js)$">
		Header set Cache-Control "max-age=2678400, private"
	</filesmatch>
</ifmodule>
';
						fputs($htaccess,$cikti);
						fclose($htaccess);
						header("Location:?islem=2");
					}
				}
			?>
			<form action="" method="post">
				<table>
					<tr><td align="right">MySQL Link:</td><td align="left"><input type="text" name="link" /></td></tr>
					<tr><td align="right">MySQL Kullanıcı Adı:</td><td align="left"><input type="text" name="kadi" /></td></tr>
					<tr><td align="right">MySQL Kullanıcı Şifre:</td><td align="left"><input type="text" name="sifre" /></td></tr>
					<tr><td align="right">MySQL Database:</td><td align="left"><input type="text" name="db" /></td></tr>
					<tr><td align="right">Sitenin Linki:</td><td align="left"><input type="text" name="dokuman" /></td></tr>
					<tr><td></td><td align="right"><input type="submit" value="Kaydet" /></td></tr>
				</table>
			</form>
			<?php
			}
			else if($islem==2){
			?>
			<h2>Yardım</h2>
			<h3>Model</h3>
			<p>
				Model dosyalarını veri tabanı işlerini yapmak için kullanırız. Böylece arayüz kodlarıyla php kodları çok içiçe geçmemiş olur.
			</p>
			<h3>View</h3>
			<p>
				View dosyaları arayüz dosyalarımızdır. Model dosyasından çekilen veriler gerektiği yerde view dosyalarımızda kullanılır.
			</p>
			<h3>Controller</h3>
			<p>
				Controller ise model ve view dosyalarımızı birleştiren dosyalarımızdır.
			</p>
			<h3>Örnek:</h3>
			<p style="text-align:left;margin-left:400px;">
				örneğin url miz http://localhost/mvc olsun<br />
				buraya göndereceğimiz verilerle herhangi bir sayfa çekelim <br />
				http://localhost/mvc/anasayfa <br />
				Sonradan eklediğimiz /anasayfa bizim ana değişkenimiz. Bu framework da bu $q olarak atanmıştır ve / lardan sonra parçalara bölünür.<br />
				Controller olarak biz $q[0] ı kullanıcaz.<br />
				Burada $q[0] ımız anasayfa dir.<br />
				Bizim anasayfa.php otomatik olarak apps/controller/anasayfa.php yi include edecektir.Sonra new $q[0]($q); ile controller class ımızı çalıştıracaktır. $q değişkenimizi de parametre olarak gönderiyoruz ki ilerde $q[1] herhangi bir şekilde lazım olduğunda kullanabilelim.<br />(Örneğin konu/15 olarak giden bir veride 15 id li konuyu çekerek kullanıcıya konu gösterilebilir)<br />
				conroller dosyamız şöyle olucak<br />
				< ? php<br />
				class controllerAdi extends controller{<br />
					public function __construct($q){
						parent::__construct();<br />
						$this->$q[0]($q);  // Farkettiyseniz burda $q[0]=controllerAdi dır<br />
					}<br />
					public function controllerAdi(){<br />
						$this->load->model($q[0]); // Model dosyamızı çağırdık
						$classModel=$q[0]."Model";
						$a=new $classModel();
						$data=$a->modelSec();
						$this->load->view($q[0],$data);
					<br />
					}
				<br />
				}<br />
				? >
				<br />
				burdan sonra artık model ve view dosyalarımız sırasıyla çalışır model dosyasından gelen $data verisi view da extract edilir ve istenilen veriler kullanılır
				<br />
				peki model dosyamız nasıl olucak
				<br />
				class ModelAdi extends model{
					<br />
					public function __construct(){
						<br />
						parent::__construct();
					}<br />
					<br />
					public function modelSec($q){
						<br />
						$id=$q[1]; // $q[1] i id olarak alıp kullanabiliriz. yukarda geçen /konu/15 gibiq[0]=konu ve $[1]=id
						<br />
						$data=array();
						<br />
						include "config.php";
						<br />
						$data["degisken"]=mysql_query("dsad");
						<br />
						return $data;<br />
					}<br />
				}
				<br />
				artık her şey hazır bir tek view dosyası kalıyor.
				orda da zaten while ile verileri fetch ederek istediğimiz yerlerde kullanılabiliyor
				<br />
				peki model view ve controller dosyalarımızın adı ne olucak?
				<br />
				örneğin sitemiz http://localhost/mvc<br />
				gönderdiğimiz get verisi ise anasayfa
				controller dosyası adımız :<b>anasayfa.php</b><br />
				model dosyası adımız : <b>anasayfa_model.php</b><br />
				view dosyası adımız : <b>anasayfa_view.php</b><br />
				zaten normal olarak bi örnek var ordan geri kalan sayfaları da kendiniz ekleyebilirsiniz. sonra istediğinizi gibi kullanabilirsiniz. 
				
				<br />
				<br />
				<h2><b>Kolay Gelsin :)</b></h2>
			</p>
			<?php
			}
			else if($islem==3){
			?>
			<h3>Hakkında</h3>
			<p>
				<h4>
					Bu MVC Framework Mustafa Çolakoğlu tarafından kodlanmıştır ve hala geliştirilmeye devam edilmektedir.
					<br />
					Kurulumdan sonra install.php dosyasını siliniz.
					<br />
					İletişim için: <a href="http://www.facebook.com/220mustafa">buraya </a> tıklayabilirsiniz.
					<br />
					Tarih:09.09.2014
				</h4>
			</p>
			<?php
			}
		?>
	</center>
</body>
</html>