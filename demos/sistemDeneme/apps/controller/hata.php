<?php
	class hata extends controller{
		public function __construct(){
			parent::__construct();
			$this->hata();
		}
		public function hata(){
			$this->load->model("hata");
			$a=new hataModel();
			$data=$a->modelSec();
			$this->load->view("hata",$data);
		}
	}
?>