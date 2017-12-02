<?php

class RequestException extends Exception {

	protected $code;
	protected $message;

	public function __construct($code, $message) {
		$this->code = $code;
		$this->message = $message;
		http_response_code($this->code);
	}

	public function toJson() {
		return json_encode(Array("code" => $this->code,
								 "message" => $this->message));
	}
}