<?php
	class ana{
		const version="1.0";
		const maker="Mustafa Çolakoğlu";
		/*
			Bu kısım sitenin view kısmına eklenmek zorundadır.
			Eğer eklenmezse siteyi Google gibi arama motorları anasayfasından başkasını indexlemez.
			Eklenme şekli: <head><link rel="canonical" href="<?php echo clk::canonical(); ?>" /></head>
		*/
		public function canonical(){
			global $q;
			include "config.php";
			$canonical=$data["site"].implode("/",$q);
			$canonical=clk::bulDegistir("//","/",$canonical);
			return $canonical;
		}
		/*
			Bu kısım sitede en başta başlatılıcak işlemleri yapar.
			session başlatma.
			token kontrol
		*/
		static function baslangic(){
			session_start();
			clk::token(1);
			clk::filter();
		}
		/*
			Bu kısım sitede veri güncellendiğinde tokeni günceller
		*/
		static function bitis(){
			clk::token(2);
		}
		/*
			Otomatik token tanımlama ve saldırılar için token güvenliği. Geliştirici isterse bu kısmı kullanabilir.
			Kullanım şekli: <form action=""><input type="hidden" name="token" value="<?php echo $_SESSION["token"]; ?>" /></form>
			Eğer formlara böyle eklenirse form işlemleri otomatik olarak saldırılardan korunucaktır.
		*/
		static function token($islem){
			if($islem==1){
				if(@$_SESSION["token"]==""){
					$_SESSION["token"]=md5(rand(1,9999));
				}
				else{}
			}
			elseif($islem==2){
				$_SESSION["token"]=md5(rand(1,9999));
			}
			elseif($islem==3){
				if(@$_POST["token"]==""){
					$token=@$_SESSION["token"];
				}
				else{
					$token=@$_POST["token"];
				}
				return $token;
			}
			else{}
		}
		/*
			Bu kısım form verilerini filtrelemek için kullanılır.
			Kullanım şekli:
				eğer tüm post ve getler içinse:
					clk::formVeriDuzelt();
				eğer sadece bir değişken içinse:
					clk::formVeriDuzelt($degiskeniniz);
				şeklinde kullanılabilir.
		*/
		static function formVeriDuzelt($degisken=false){
			if($degisken){
				$degisken=ana::bulDegistir('"',"&#34",$degisken);
				$degisken=ana::bulDegistir("%","&#37",$degisken);
				$degisken=ana::bulDegistir("'","&#39",$degisken);
				$degisken=ana::bulDegistir("?","&#63",$degisken);
				$degisken=ana::bulDegistir("`","&#96",$degisken);
				$degisken=ana::bulDegistir("‘","&#8216",$degisken);
				$degisken=ana::bulDegistir("’","&#8217",$degisken);
				$degisken=ana::bulDegistir("“","&#8220",$degisken);
				$degisken=ana::bulDegistir("”","&#8221",$degisken);
				$degisken=ana::bulDegistir(":","&#58",$degisken);
				$degisken=ana::bulDegistir(";","&#59",$degisken);
				$degisken=ana::bulDegistir("<","&#60",$degisken);
				$degisken=ana::bulDegistir("=","&#61",$degisken);
				$degisken=ana::bulDegistir(">","&#62",$degisken);
				$degisken=ana::bulDegistir(">","&#62",$degisken);
				return $degisken;
			}
			else{
				foreach($_POST as $key=>$value){
					$_POST[$key]=ana::bulDegistir('"',"&#34",$_POST[$key]);
					$_POST[$key]=ana::bulDegistir("%","&#37",$_POST[$key]);
					$_POST[$key]=ana::bulDegistir("'","&#39",$_POST[$key]);
					$_POST[$key]=ana::bulDegistir("?","&#63",$_POST[$key]);
					$_POST[$key]=ana::bulDegistir("`","&#96",$_POST[$key]);
					$_POST[$key]=ana::bulDegistir("‘","&#8216",$_POST[$key]);
					$_POST[$key]=ana::bulDegistir("’","&#8217",$_POST[$key]);
					$_POST[$key]=ana::bulDegistir("“","&#8220",$_POST[$key]);
					$_POST[$key]=ana::bulDegistir("”","&#8221",$_POST[$key]);
					$_POST[$key]=ana::bulDegistir(":","&#58",$_POST[$key]);
					$_POST[$key]=ana::bulDegistir(";","&#59",$_POST[$key]);
					$_POST[$key]=ana::bulDegistir("<","&#60",$_POST[$key]);
					$_POST[$key]=ana::bulDegistir("=","&#61",$_POST[$key]);
					$_POST[$key]=ana::bulDegistir(">","&#62",$_POST[$key]);
					$_POST[$key]=ana::bulDegistir(">","&#62",$_POST[$key]);
				}
				foreach($_GET as $key=>$value){
					$_GET[$key]=ana::bulDegistir('"',"&#34",$_GET[$key]);
					$_GET[$key]=ana::bulDegistir("%","&#37",$_GET[$key]);
					$_GET[$key]=ana::bulDegistir("'","&#39",$_GET[$key]);
					$_GET[$key]=ana::bulDegistir("?","&#63",$_GET[$key]);
					$_GET[$key]=ana::bulDegistir("`","&#96",$_GET[$key]);
					$_GET[$key]=ana::bulDegistir("‘","&#8216",$_GET[$key]);
					$_GET[$key]=ana::bulDegistir("’","&#8217",$_GET[$key]);
					$_GET[$key]=ana::bulDegistir("“","&#8220",$_GET[$key]);
					$_GET[$key]=ana::bulDegistir("”","&#8221",$_GET[$key]);
					$_GET[$key]=ana::bulDegistir(":","&#58",$_GET[$key]);
					$_GET[$key]=ana::bulDegistir(";","&#59",$_GET[$key]);
					$_GET[$key]=ana::bulDegistir("<","&#60",$_GET[$key]);
					$_GET[$key]=ana::bulDegistir("=","&#61",$_GET[$key]);
					$_GET[$key]=ana::bulDegistir(">","&#62",$_GET[$key]);
				}
			}
		}
		/*
			Bu kısım eğer dışardan gelinmişse devreye girer ve form verilerini temizleme fonksiyonlarını çalıştırır.
		*/
		static function filter(){
			$gelen=@$_SERVER["HTTP_REFERER"];
			include "config.php";
			if($gelen!=""){
				if($_POST || $_GET){
					if(substr($gelen,0,strlen($data["site"]))==$data["site"]){}
					else{
						clk::formVeriDuzelt();
					}
				}
				else{}
			}else{}
		}
		/*
			Eğer bir değişkenden kendi istediğimiz karakterleri çıkarmak istiyorsak veya id lerden gelebilicek injection saldırılarına karşı kullanabiliriz.
			Kullanım şekli:
				injection saldırılarından korunmak için:
					clk::temizle($id);
				istediğimiz herhangi bir karakteri silmek için:
					clk::temizle($id,"karakterin");
		*/
		static function temizle($temizlenen,$belirli=false){
			if($belirli==""){
				$cikar="'".'";/.,*=-+abcçdefgğhıijklmnoöprsştuüvyzABCÇDEFGĞHIİJKLMNOÖPRSŞTUÜVYZ';
			}
			else{
				$cikar=$belirli;
			}
			$count=strlen($cikar);
			$temizle=$temizlenen;
			for($i=0;$i<$count;$i++){
				$temizle=str_replace(substr($cikar,$i,1),"",$temizle);
			}
			return $temizle;
		}
		/*
			Herhangi bir string değişkenden istediğimiz bir kısmı almak istiyorsak öncesini,sonrasını,değişken şeklinde parametreler göndererek sadece istediğimiz kısmı alabiliriz
			Kullanımı:
				$metin="aaabbbcc";
				biz "aaa" ile "ccc" arasını almak istiyoruz
				$yeni=clk::merl("aaa","bbb",$metin);
		*/
		static function merl($baslanacak,$bitecek,$veri){
			$al=0;
			$yirmi=0;
			$yeniVeri="";
				for($i=0;$i<=strlen($veri);$i++){
					if(substr($veri,$i,strlen($baslanacak))==$baslanacak){
						$al=1;
					}else{}
					if(substr($veri,$i,strlen($bitecek))==$bitecek){
						$al=0;
						break;
					}
					else{}
					if($al==1){
						$yeniVeri=$yeniVeri.substr($veri,$i,1);
					}
					else{}
				}
			return $yeniVeri;
		}
	var	$sayac=0;
	static function duzenle($yazi){
			global $sayac;
			$a=clk::merl("[LINK]","[/LINK]",$yazi);
			$a=str_replace("[LINK]","",$a);
			$a=str_replace("[/LINK]","",$a);
			$y='<a href="'.$a.'" class="link">'.$a.'</a>';
			$yazi=str_replace("[LINK]".$a."[/LINK]",$y,$yazi);
			$sayac++;
			$a=clk::merl("[IMG]","[/IMG]",$yazi);
			$a=str_replace("[IMG]","",$a);
			$a=str_replace("[/IMG]","",$a);
			$y='<img src="'.$a.'" alt="" class="resim" />';
			$yazi=str_replace("[IMG]".$a."[/IMG]",$y,$yazi);
			$sayac++;
			$a=clk::merl("[HTML]","[/HTML]",$yazi);
			$a=str_replace("[HTML]","",$a);
			$a=str_replace("[/HTML]","",$a);
			$y='<h2>HTML KOD:</h2><br /><div id="kod'.$sayac.'" class="editor">'.$a.'</div><script src="http://ace.c9.io/build/src-min-noconflict/ace.js" type="text/javascript" charset="utf-8"></script><script>var editor = ace.edit("kod'.$sayac.'");editor.setTheme("ace/theme/clouds");editor.getSession().setMode("ace/mode/html");</script>';
			$yazi=str_replace("[HTML]".$a."[/HTML]",$y,$yazi);
			$sayac++;
			$a=clk::merl("[CSS]","[/CSS]",$yazi);
			$a=str_replace("[CSS]","",$a);
			$a=str_replace("[/CSS]","",$a);
			$y='<h2>CSS KOD:</h2><div id="kod'.$sayac.'" class="editor">'.$a.'</div><script src="http://ace.c9.io/build/src-min-noconflict/ace.js" type="text/javascript" charset="utf-8"></script><script>var editor = ace.edit("kod'.$sayac.'");editor.setTheme("ace/theme/clouds");editor.getSession().setMode("ace/mode/css");</script>';
			$yazi=str_replace("[CSS]".$a."[/CSS]",$y,$yazi);
			$sayac++;
			$a=clk::merl("[PHP]","[/PHP]",$yazi);
			$a=str_replace("[PHP]","",$a);
			$a=str_replace("[/PHP]","",$a);
			$y='<h2>PHP KOD:</h2><div id="kod'.$sayac.'" class="editor">'.$a.'</div><script src="http://ace.c9.io/build/src-min-noconflict/ace.js" type="text/javascript" charset="utf-8"></script><script>var editor = ace.edit("kod'.$sayac.'");editor.setTheme("ace/theme/clouds");editor.getSession().setMode("ace/mode/php");</script>';
			$yazi=str_replace("[PHP]".$a."[/PHP]",$y,$yazi);
			$sayac++;
			$a=clk::merl("[JS]","[/JS]",$yazi);
			$a=str_replace("[JS]","",$a);
			$a=str_replace("[/JS]","",$a);
			$y='<h2>JS KOD:</h2><div id="kod'.$sayac.'" class="editor">'.$a.'</div><script src="http://ace.c9.io/build/src-min-noconflict/ace.js" type="text/javascript" charset="utf-8"></script><script>var editor = ace.edit("kod'.$sayac.'");editor.setTheme("ace/theme/clouds");editor.getSession().setMode("ace/mode/js");</script>';
			$yazi=str_replace("[JS]".$a."[/JS]",$y,$yazi);
			$sayac++;
			return $yazi;
		}
		/*
			Bu kısım bir metinden istediğimiz herhangi bir veriyi bulup değiştirmek için kullanılır
		*/
		static function bulDegistir($bul,$degistir,$yazi){
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
		/*
			Cache başlangıç
		*/
		/*
			Bu kısım cache dosyası var mı yok mu diye kontrol eder
			varsa model dosyası yeni bir cache açmaz
		*/
		static function cacheKontrol($file){
			include "config.php";
			if(file_exists($data["file"]."/cache/".$file)){
				include $data["file"]."/cache/".$file;
				if($time+$cacheTime<=time()){
					return false;
				}
				else{
					return true;
				}
			}
			else{
				return false;
			}
		}
		/*
			Bu kısım cache dosyasına eklenicek verileri diziye çevirir
		*/
		static function cacheDizi($dizi,$diziName){
			$ekle="";
			foreach($dizi as $s){
				$c="";
				foreach($s as $a=>$b){
					$c=',"'.$a.'"=>'.'"'.$b.'"'.$c;
				}
				$c=ltrim($c,",");
				$ekle="array(".$c."),".$ekle.",";
			}
			$c='$data["'.$diziName.'"]';
			$ekle=rtrim($ekle,",");
			return array($ekle,$c);
		}
		/*
			Bu kısım ise cache dosyasını oluturmamıza yarar.
		*/
		static function cacheDosyaOlustur($dosyaAdi,$puts){
			$dosya=fopen($dosyaAdi,"w");
			fputs($dosya,$puts);
			fclose($dosya);
		}
		/*
			Bu kısım herhangi bir saldırıya karşı her 10 dk da bir cache dosyalarını kontrol eder ve aynısından kaç tane varsa siler
		*/
		static function cacheOnlem($cacheDosya){
			include "config.php";
			if(@file_exists($data["file"]."/system/sistemBilgi/cacheSecureTime.php")){
				include $data["file"]."/system/sistemBilgi/cacheSecureTime.php";
				/* Kontrol Kısmı */
				$kontrol=time();
				if($sonZaman+18000>=$kontrol){
					$dosya=fopen($data["file"]."/system/sistemBilgi/cacheSecureTime.php","w");
					fputs($dosya,"<?php
	$"."sonZaman=".time().";
?>");
					fclose($dosya);
				}else{
					$ac1=opendir($data["file"]."/cache");
					while($dosya1=readdir($ac1)){
						if($dosya1=="." || $dosya1==".."){}
						else{
							$ac2=opendir($data["file"]."/cache");
							while($dosya2=readdir($ac2)){
								if($dosya2=="." || $dosya2==".." || $dosya2==$dosya1){}
								else{
									@include $data["file"]."/cache/".$dosya1;
									$data1=$data;
									@include $data["file"]."/cache/".$dosya2;
									$data2=$data;
									if($data1==$data2 && $dosya1!=$cacheDosya){
										@unlink($data["file"]."/cache/".$dosya1);
									}
									else{}
								}
							}
						}
					}
				}
			}
			else{
				$dosya=fopen($data["file"]."/system/sistemBilgi/cacheSecureTime.php","w");
				fputs($dosya,"<?php
	$"."sonZaman=".time().";
?>");
				fclose($dosya);
			}
		}
		/*
			Cache bitiş.
		*/
	}
?>