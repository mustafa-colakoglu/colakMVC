<?php
	class anasayfaModel extends model{
		public function __construct(){
			parent::__construct();
		}
		public function modelSec($q){
			$data["a"]=$this->select("ekle");
			return $data;
		}
		public function __destruct(){
			$db=null;
		}
	}
?>