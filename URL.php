<?php

class Url {

	protected $url;
	protected $data;
	protected $response;

	function __construct($url, $data = null) {
		$this->url = $url;
		$this->data = $data;
		if (!is_null($data)) {
			$this->url .= "?";
			$i = 0;
			while ($i < count($data)) {
				$this->url .= key($data) . "=" . current($data);
				if (!next($data)) return;
				$this->url .= "&";
				$i++;
			}
		}
	}

	public function getUrl() {
		return $this->url;
	}

	public function getResponse(){
		if(!is_null($this->response))
			return $this->response;
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL, $this->url);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		$this->response = curl_exec($curl);
		$this->response = json_decode($this->response, true);
		curl_close($curl);
		return $this->response;
	}

}
