<?php
	class model extends PDO{
		public function __construct(){
			include "config.php";
			$db=parent::__construct("mysql:host=".$mysql["site"].";dbname=".$mysql["db"],$mysql["kadi"],$mysql["sifre"]);
		}
		public function select($tablo,$where=false,$satir=false,$diger=false,$cacheName=false,$cacheTime=false){
			global $q;
			include "config.php";
			if($where){
				$where="WHERE ".$where;
			}
			else{
				$where="";
			}
			if($satir){
				$satir=$satir;
			}
			else{
				$satir="*";
			}
			if($diger){
				$diger=$diger;
			}
			else{
				$diger="";
			}
			if($cacheName==false){
				$sql=("SELECT ".$satir." FROM ".$tablo." ".$where." ".$diger);
				$dizi = $this->prepare($sql);
				$dizi->execute();
				return $dizi->fetchAll();
			}
			else{
				$yeniQ=implode(".",$q);
				$yeniQ=rtrim($yeniQ,".");
				$yeniQ=md5($yeniQ).".php";
				$kontrol=clk::cacheKontrol($yeniQ);
				if($kontrol){
					include $data["file"]."/cache/".$yeniQ;
					if($data[$cacheName]){
						return array_reverse($data[$cacheName]);
					}
					else{
						#header("Location:".$data["doc"].implode("/",$q));
						/*
							Bu kısımlar daha sonra düzeltilicek sonsuz header oluyo bu yüzden bu sayfad sorguyu yaptır sonra da cache Dosyasını oluştur ondan sonra yönlendirme yap
						*/
					}
				}
				else{
					$time=time();
					if($cacheTime){}
					else{
						$cacheTime=3600;
					}
					$sql=("SELECT ".$satir." FROM ".$tablo." ".$where." ".$diger);
					$dizi = $this->prepare($sql);
					$dizi->execute();
					$dizi2 = $this->prepare($sql);
					$dizi2->execute();
					$diziOlustur=clk::cacheDizi($dizi->fetchAll(),$cacheName);
					clk::cacheDosyaOlustur($data["file"]."/cache/".$yeniQ,"<?php
	$"."time=".$time.";
	$"."cacheTime=".$cacheTime.";
	".$diziOlustur[1]."=array(".$diziOlustur[0].");
?>");
					return $dizi2->fetchAll();
				}
			}
		}
		public function insert($tablo,$satirlar,$degerler){
			$sql="INSERT INTO ".$tablo."(".$satirlar.") VALUES(".$degerler.")";
			if(clk::token(3)==$_SESSION["token"]){
				clk::bitis();
				return $this->query($sql);
			}else{}
		}
		public function update($tablo,$set,$where=false,$diger=false){
			if($where){
				$sql="UPDATE ".$tablo." SET ".$set." WHERE ".$where;
			}
			else{
				$sql="UPDATE ".$tablo."SET ".$set;
			}
			if(clk::token(3)==$_SESSION["token"]){
				clk::bitis();
				return $this->query($sql);
			}else{}
		}
		public function delete($tablo,$where=false){
			if($where){
				$sql="DELETE FROM ".$tablo." WHERE ".$where;
			}
			else{
				$sql="DELETE FROM ".$tablo;
			}
			if(clk::token(3)==$_SESSION["token"]){
				clk::bitis();
				return $this->query($sql);
			}else{}
		}
		public function tam($sql){
			if(clk::token(3)==$_SESSION["token"]){
				clk::bitis();
				return $this->query($sql);
			}else{}
		}
		public function __destruct(){}
	}
?>