<?php
	class anasayfa extends controller{
		public function __construct($q){
			parent::__construct();
			$this->$q[0]($q);
		}
		public function anasayfa($q){
			$this->load->model($q[0]);/* model dosyalarımızı include ettik */
			$classModel=$q[0]."Model";
			$a=new $classModel($q[0]);/* model dosyamızı çalıştırdık */
			$data=$a->modelSec();/* verilerimizi çektik */
			$this->load->view($q[0],$data);/* view dosyamızı include ettik $data değişkenimizi de gönderdik */
		}
	}
?>