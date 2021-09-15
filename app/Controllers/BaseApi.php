<?php

namespace App\Controllers;

use CodeIgniter\API\ResponseTrait;
use App\Models\AdminAuthenticationModel;
use App\Models\AuthenticationModel;
use App\Models\UserModel;
use App\Models\AdminModel;

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

use CodeIgniter\Controller;

class BaseApi extends Controller
{
	use ResponseTrait;
	/**
	 * An array of helpers to be loaded automatically upon
	 * class instantiation. These helpers will be available
	 * to all other controllers that extend BaseController.
	 *
	 * @var array
	 */
	protected $helpers = [];
	private $auth_key_admin = 'dbmu28fv08Q1wZ4hce0wsrFT6Jq1sVag';
	private $auth_key_user = '1LXDxkUNHRk8dwLugridlTf25ONcZIxy';

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
		// $this->session = \Config\Services::session();
	}

	protected function validateInput($rules)
	{
		$data = json_decode(file_get_contents('php://input'), true);
		$validation =  \Config\Services::validation();
		$validation->run($data, $rules);
		$errors = $validation->getErrors();
		return $errors;
	}

	protected function checkRequest($method = 'get', $rule = null)
	{
		if ($this->request->getMethod() == $method) {
			$auth_key  = $this->request->getHeaderLine('Auth-Key');
			if ($auth_key == $this->auth_key_admin) {
				if ($rule != null) {
					$errors = $this->validateInput($rule);
					if ($errors) {
						return array('respond' => false, 'status' => 400, 'message' => 'Data Validation Errors', 'errors' => $errors, 'status_message' => 'Data Validation Errors');
					} else {
						return array('respond' => true, 'status' => 200, 'role' => 'admin');
					}
				} else {
					return array('respond' => true, 'status' => 200, 'role' => 'admin');
				}
			} else {
				return array('respond' => false, 'status' => 401, 'message' => 'Unauthorized. Please Provide Valid Authentication Key');
			}
		} else {
			return array('respond' => false, 'status' => 400, 'message' => 'Bad request');
		}
	}

	protected function checkVal($check){
		if( (empty($check))||($check==null) ){
			return array();
		}else{
			if(is_array($check)){
				if(count($check)>0){
					if(array_key_exists("0",$check)){
						$x = $check;
						return $x[0];
					}else{
						return $check;
					}
				}else{
					return array();
				}
			}else{
				return $check;
			}
		}
	}

	protected function sendRespond($respond)
	{
		$respondData = $respond;
		if (isset($respond['status_message'])) {
			unset($respondData['respond'], $respondData['status_message']);
			return $this->respond($respondData, $respond['status'], $respond['status_message']);
		} else {
			unset($respondData['respond']);
			return $this->respond($respondData, $respond['status']);
		}
	}

	protected function auth_admin()
	{
		$user_id  = $this->request->getHeaderLine('ID');
		$token  = $this->request->getHeaderLine('Token');
		$authentication = new AdminAuthenticationModel();
		$auth = $authentication->getAuthID(array('user_id' => $user_id, 'token' => $token));
		if ($auth['respond']) {
			$authentication->save(array('id' => $auth['id'], 'expired_at' => date("Y-m-d H:i:s", strtotime("+2 week"))));
			$adminModel = new AdminModel();
			$admin = $adminModel->find($user_id);
			unset($admin['password'], $admin['deleted_at']);
			return array('respond' => true, 'status' => 200, 'user' => $admin);
		} else {
			return $auth;
		}
	}

	protected function auth_user()
	{
		$user_id  = $this->request->getHeaderLine('ID');
		$token  = $this->request->getHeaderLine('Token');
		$authentication = new UserAuthenticationModel();
		$auth = $authentication->getAuthID(array('user_id' => $user_id, 'token' => $token));
		if ($auth['respond']) {
			$authentication->save(array('id' => $auth['id'], 'expired_at' => date("Y-m-d H:i:s", strtotime("+1 hours"))));
			$userModel = new UserModel();
			$user = $userModel->find($user_id);
			unset($user['password'], $user['deleted_at']);
			return array('respond' => true, 'status' => 200, 'user' => $user);
		} else {
			return $auth;
		}
	}

	protected function isAdmin()
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


}
