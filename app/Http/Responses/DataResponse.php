<?php

namespace App\Http\Responses;

use Illuminate\Http\Response;

class DataResponse extends Response {
	private $data;
	private $id;

	/**
	 * DataResponse constructor.
	 *
	 * @param $data
	 */
	public function __construct( $data, $id = "", $content = '', $status = 200, $headers = [] ) {
		$this->data = $data;
		$this->id = $id;
		parent::__construct( $content, $status, $headers );
	}

	/**
	 * @return string
	 */
	public function getId() {
		return $this->id;
	}

	/**
	 * @param string $id
	 */
	public function setId( $id ) {
		$this->id = $id;
	}

	/**
	 * @return mixed
	 */
	public function getData() {
		return $this->data;
	}

	/**
	 * @param mixed $data
	 */
	public function setData( $data ) {
		$this->data = $data;
	}


}