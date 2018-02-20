<?php 
include 'Classes/PHPExcel/IOFactory.php';

class ImportXL{
	public $file;
	protected $data;
	protected $log;
	public function __construct($file)
	{
		$this->file = $file;
		$this->data = $this->eachFile();
		$this->log = array('success' => 0, 'error' => 0);
	}
	public function save($data){
		$add = $this->db->prepare("INSERT INTO ".$this->table."(kode,lemari,rak,arsip) VALUES(:A, :B, :C, :D)");
		foreach ($data as $key => $value) {
			$add->bindParam(":".$key, $value,PDO::PARAM_STR);
		}
		if ($add->execute()) {
			$this->log['success'] +=1; 
		}
		else $this->log['error'] +=1; 

		return $add->fetch(PDO::FETCH_OBJ);
	}

	public function saveFile(){
		foreach ($this->data as $data) {
            print_r($data);
		}
	}

    public function getData(){
        return $this->data; 
    }
	public function printLog(){
		$msg = "Error : ".$this->log['error']." Success : ".$this->log['success'];
		echo "<script>alert('$msg')</script>;";
	}

	public function eachFile(){
		$inputFileType = PHPExcel_IOFactory::identify($this->file);
		/**  Create a new Reader of the type that has been identified  **/
		$objReader = PHPExcel_IOFactory::createReader($inputFileType);
		$objPHPExcel = $objReader->load($this->file);
		$sheetData = $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);
		$data = array();

		foreach ($sheetData as $key => $value) {
			array_push($data, array_filter($value, 'strlen'));
		}
		unset($data[0]);
		return $data;
	}

}


?>
