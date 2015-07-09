<?php
	class anasayfa extends controller{
		public function __construct($q){
			parent::__construct();
			$this->$q[0]($q);
		}
		public function anasayfa($q){
			$a=$this->load->model($q[0]);
			$data=$a->modelSec($q);
			$this->load->view($q[0],$data);
		}
	}
?>