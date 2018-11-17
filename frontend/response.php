<?php
class Response {
	private $responseSuccess;
	private $responseError;
	private $data;
	public function __construct() {
		$this->responseSuccess['success'] = true;
		$this->responseError['success'] = false;
	}
	public function JSONSuccess($status) {
		$this->responseSuccess['success'] = true;
		$this->responseSuccess['status'] = $status;
		$this->responseSuccess['data'] = $this->data;
		$json = json_encode($this->responseSuccess);
		if(!$json) {
			die('{"success":false,"status":"json_encode failed!"}');
		} else {
			die($json);
		}
	}
	public function JSONError($status) {
		$this->responseError['success'] = false;
		$this->responseError['status'] = $status;
		$json = json_encode($this->responseError);
		if(!$json) {
			die('{"success":false,"status":"json_encode failed!"}');
		} else {
			die($json);
		}
	}
	public function addElement($key, $value) {
  		$this->data[$key] = $value;
	}
	public function removeElement($key) {
		unset($this->data[$key]);
	}
}
$response = new Response();
?>
