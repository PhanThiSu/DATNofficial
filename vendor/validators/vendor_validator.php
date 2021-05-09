<?php
trait vendor_validator {
	public static function convertErrorMessage($errmsgs) {
		$rs = [];
		foreach ($errmsgs as $key => $value) {
			$rs[$key] = implode("<br>",$value);
		}
		return $rs;
	}

	public function requiredField($value) {
		if(!strlen(trim($value)))
			return ['status'=>false, 'message'=>"Trường này không được để trống!"];
		else return ['status'=>true];
	}

	public function minField($value, $length) {
		if(strlen($value)<$length) 
			return ['status'=>false, 'message'=>"Độ dài của trường này không được nhỏ hơn $length ký tự! "];
		else return ['status'=>true];
	}

	public function maxField($value, $length) {
		if(strlen($value)>$length) 
			return ['status'=>false, 'message'=>"Độ dài của trường này không được nhiều hơn $length ký tự!"];
		else return ['status'=>true];
	}

	public function booleanField($value) {
		if(is_bool($value))
			return ['status'=>true];
		else return ['status'=>false, 'message'=>"Loại trường này phải là boolean!"];
	}

	public function integerField($value) {
		if(is_int($value))
			return ['status'=>true];
		else return ['status'=>false, 'message'=>"Loại trường này phải là số nguyên!"];
	}

	public function floatField($value) {
		if(is_float($value))
			return ['status'=>true];
		else return ['status'=>false, 'message'=>"Vui lòng nhập số thực!"];
	}

	public function doubleField($value) {
		if(is_double($value))
			return ['status'=>true];
		else return ['status'=>false, 'message'=>"Loại trường này phải là số thực!"];
	}
 
	public function numberField($value) {
		if(is_numeric($value))
			return ['status'=>true];
		else return ['status'=>false, 'message'=>"Trường này phải là số!"];
	}

	public function stringField($value) {
		if(is_string($value))
			return ['status'=>true];
		else return ['status'=>false, 'message'=>"Loại trường này phải là chữ"];
	}

	public function emailField($value) {
		if (filter_var($value, FILTER_VALIDATE_EMAIL)) {
		  	return ['status'=>true];
		} else return ['status'=>false, 'message'=>"Định dạng email không hợp lệ"];
	}

	public function urlField($value) {
		if (preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i",$value)) {
			return ['status'=>true];
		} else return ['status'=>false, 'message'=>"Invalid url format!"];
	}

	public function fileField() {
		return ['status'=>true];
	}

	public function imageField() {
		return ['status'=>true];
	}

	public function uniqueField($value, $field, $editId=false) {
		if($editId===false)
			$checkExist = $this->getCountRecords(['conditions'=>$field.'="'.$value.'"']);
		else 	$checkExist = $this->getCountRecords(['conditions'=>$field.'="'.$value.'" AND id<>'.$editId]);
		if($checkExist)
			return ['status'=>false, 'message'=>"Giá trị này đã tồn tại!"];
		else
			return ['status'=>true];
	}

	public function matchPasswordField($value, $value2) {
		if(($value == $value2) == 1)
			return ['status'=>true];
		else
			return ['status'=>false, 'message'=>"Mật khẩu không khớp!"];
	}

	public function inlistField($value, $list) {
		if (in_array($value, $list)) {
			return ['status'=>true];
		} return ['status'=>false, 'message'=>"Giá trị của trường này phải bằng  ".implode(", ",$list)];
	}

	public static function datetimeField($datetime, $format = 'Y-m-d H:i:s')
	{
		if(substr_count($datetime, ':') < 2)	$datetime .= ":00";
	    $d = DateTime::createFromFormat($format, $datetime);
	    if($d && $d->format($format) == $datetime)
			return ['status'=>true];
		else
	    	return ['status'=>false, 'message'=>"Ngày giờ không hợp lệ!"];
	}
}
?>
