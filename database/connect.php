<?php

class database {
    public $servername="localhost";  // Host address
	public $username="root";
	public $pass="";
	public $db_name="onlineshopping";
	public $link;
	public $error;
	public $sms;

	//Database Connection Start
	//Constructor
	public function __construct()
	{
		$this->db_connect();
	}

	private function db_connect()
	{
		$this->link= new mysqli($this->servername,$this->username,$this->pass,$this->db_name) or die ("Database Connection failed!".$this->link->error."(".$this->link->errno.")");
		if($this->link)
		{
			$this->sms="Connected!!";
		}
	}
		
	 function insert($sql)
	 {
 		$query=$this->link->query($sql);
 		if($query)
 		{
 			$this->sms="Inserted Successfully!!";
 		}
 		else
 		{
 			$this->sms="Inserted Unsuccessfully!!";
 		}
	 }

	// ID Generate---->
	function makeid($tableName, $fieldName, $prefix, $length)
	{
		// ITEM-00001
	 	$sql=$this->link->query("SELECT MAX($fieldName) FROM $tableName");
	 	$fetch=$sql->fetch_array();
	 	$MaxID=$fetch[0]; // id
	 	$prefix_length=strlen($prefix); // 5
	 	//echo $prefix_length;

	 	// substr('Nahian',2) => hian
	 	$onlyId=substr($MaxID,$prefix_length);  // Output: 00001 (str)
	 	//echo $onlyId;
	 	$new=(int)($onlyId);  // 00001 => 1
	 	//echo $new;
	 	$new++;
	 	$id_length=strlen($new); // 1

	 	$number_of_zero=$length-($prefix_length + $id_length);
	 	//echo $number_of_zero;

	 	$zero=str_repeat('0',$number_of_zero);
	 	//echo $zero;

	 	$newId=$prefix.$zero.$new;
	 	//echo $newId;
	 	
	 	return($newId);
	}


	public function _destruct()
	{
		$this->link->close();
	}

}

?>



