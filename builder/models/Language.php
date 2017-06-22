<?php

class Language {

	public $id;
	public $code;
	public $name;

	//construtor da classe
	public function __construct($array){

		//se o array não estiver vazio, inicializar as propriedades do objeto com os valores do array
		if (!empty($array)) {
			$this->id = $array['LANGUAGE_ID'];
			$this->code = $array['LANGUAGE_CODE'];
			$this->name = $array['LANGUAGE_NAME'];
		}
  }

	public function __destruct(){

	}

	public function getAllLanguages(){

		$DB = fnDBConn();

		$SQL = "SELECT LAN.ID AS LANGUAGE_ID, LAN.CODE AS LANGUAGE_CODE, LAN.NAME AS LANGUAGE_NAME
						FROM FIRST_LANGUAGE AS LAN
						WHERE 1";

		$RESULT = fnDB_DO_SELECT_WHILE($DB,$SQL);

		$arrLanguages = [];

		foreach($RESULT as $KEY => $ROW){
			$language = new Language($ROW);
			array_push($arrLanguages, $language);
		}

		return $arrLanguages;
	}

}
?>
