<?php
	class anasayfaModel extends model{
		public function __construct(){
			parent::__construct();
		}
		public function modelSec(){
			$data=array();
			$data["yazilar"]=$this->select("yazilar","","baslik","","yazilar","30");
			return $data;
		}
		public function __destruct(){
			$db=null;
		}
	}
?>