<?php

namespace App\Controllers;

use CodeIgniter\Controller;

/**
 * Class BaseController
 *
 * BaseController provides a convenient place for loading components
 * and performing functions that are needed by all your controllers.
 * Extend this class in any new controllers:
 *     class Home extends BaseController
 *
 * For security be sure to declare any new methods as protected or private.
 *
 * @package CodeIgniter
 */

class BaseController extends Controller
{
	/**
	 * An array of helpers to be loaded automatically upon
	 * class instantiation. These helpers will be available
	 * to all other controllers that extend BaseController.
	 *
	 * @var array
	 */

	/**
	 * Constructor.
	 */
	public function initController(\CodeIgniter\HTTP\RequestInterface $request, \CodeIgniter\HTTP\ResponseInterface $response, \Psr\Log\LoggerInterface $logger)
	{
		// Do Not Edit This Line
		parent::initController($request, $response, $logger);

		//--------------------------------------------------------------------
		// Preload any models, libraries, etc, here.
		//--------------------------------------------------------------------
		// E.g.:
		$this->session = \Config\Services::session();
	}

	protected function isAdmin()
	{
		$userId = $this->session->get('userId');
		if (!isset($userId) || $userId == null || $userId == '') {
			return false;
		} else {
			if($this->session->get('role')!=='admin') {
				return false;
			}
			return true;
		}
	}

	protected function isUser()
	{
		$userId = $this->session->userdata('userId');

		if (!isset($userId) || $userId == null || $userId == '') {
			return false;
		} else {
			$token_exp = $this->session->userdata('token_exp');

			if(empty($token_exp) || strtotime(date('Y-m-d H:i:s')) >= strtotime($token_exp)) {
				return false;
			}
			return true;
		}
	}


	protected function sendRequest($url = 'url', $method = 'get', $params = null)
	{
		$client = \Config\Services::curlrequest();
		$res = $client->request($method, $url, [
				'verify' => false,
				'headers' => [
					'Content-Type' => 'application/json'
				],
				'connect_timeout' => 60,
				'json' => $params
		]);
		return $res->getBody();
	}	

	protected function sendRequestWithAdminAuth($url = 'url', $method = 'get', $params = null)
	{
		$client = \Config\Services::curlrequest();
		$response = $client->request($method, $url, [
				'verify' => false,
				'headers' => [
					'Auth-Key' => 'dbmu28fv08Q1wZ4hce0wsrFT6Jq1sVag',
					'Content-Type' => 'application/json',
					'ID' => $this->session->userdata('userId'),
					'Token' => $this->session->userdata('token')
				],
				'json' => $params
		]);
		return $response->getBody();
	}

	protected function sendRequestWithUserAuth($url = 'url', $method = 'get', $params = null)
	{
		$client = \Config\Services::curlrequest();
		$response = $client->request($method, $url, [
				'verify' => false,
				'headers' => [
					'Auth-Key'     => '1LXDxkUNHRk8dwLugridlTf25ONcZIxy',
					'Content-Type'      => 'application/json',
					'ID'             => $this->session->userdata('userId'),
					'Token'     => $this->session->userdata('token')
				],
				'json' => $params
		]);
		return $response->getBody();
	}


}
