<?php

namespace GiorgioMa\MailtrainApiPhp;

use GuzzleHttp\Client;

class NewsletterApi {
	
	public function __construct($host, $token) {

		$this->host = $host;
		$this->token = $token;
		$this->client = new Client;

	}

	public function getSubscriptions($listID) {
		$url = '/api/subscriptions/'. $listID;
		return $this->request('GET', $url);
	}

	public function subscribe($listID, $params) {
		$url = '/api/subscribe/'. $listID;

		if(! in_array('TIMEZONE', $params) ) {
			$params['TIMEZONE'] = date_default_timezone_get();
		}

		return $this->request('POST', $url, [ 'form_params' => $params ]);
	}

	public function unsubscribe($listID, $email) {
		$url = '/api/unsubscribe/'. $listID;
		return $this->request('POST', $url, [ 'form_params' => [ 'EMAIL' => $email ]]);
	}

	public function delete($listID, $email) {
		$url = '/api/delete/'. $listID;
		return $this->request('POST', $url, [ 'form_params' => [ 'EMAIL' => $email ]]);
	}

	public function addField($listID, $params) {
		$url = '/api/field/'. $listID;
		return $this->request('POST', $url, [ 'form_params' => $params ]);
	}

	public function getBlacklist($params = []) {
		$url = '/api/blacklist/get';
		return $this->request('GET', $url, $params);
	}

	public function addBlacklist($email) {
		$url = '/api/blacklist/add';
		return $this->request('POST', $url, [ 'form_params' => ['EMAIL' => $email ]]);
	}

	public function getLists($email = null) {
		$url = '/api/lists';
		if(!is_null($email)) {
			$url.= '/'.$email;
		}
		return $this->request('GET', $url);
	}

	public function getList($ID) {
		$url = '/api/list/'.$ID;
		return $this->request('GET', $url);
	}

	private function request($type, $url, $params = []) {

		$url = $this->host . $url .'?access_token=' . $this->token;
		$response = $this->client->request($type, $url, $params);
		$body = $response->getBody();

		return $body;

	}

}