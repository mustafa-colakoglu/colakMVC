<?php
	class anasayfa extends controller{
		public function __construct($q){
			parent::__construct();
			$this->$q[0]($q);
		}
		public function anasayfa($q){
			$a=$this->load->model($q[0]);/* model dosyalarımızı include ettik */
			$data=$a->modelSec($q);/* Verimizi aldık */
			$this->load->view($q[0],$data);/* view dosyamızı include ettik $data değişkenimizi de gönderdik */
		}
	}
?>