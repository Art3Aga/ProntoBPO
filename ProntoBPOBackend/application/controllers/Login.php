<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once(APPPATH.'/libraries/REST_Controller.php');
use Restserver\libraries\REST_Controller;

class Login extends REST_Controller {

	public function __construct(){
		header("Access-Control-Allow-Methods: PUT, GET, POST, DELETE, OPTIONS");
		header("Access-Control-Allow-Headers: Content-Type, Content-Length, Accept-Encoding");
		header("Access-Control-Allow-Origin: *");
		parent::__construct();
		$this->load->database();
		$this->load->helper('date');
		$this->load->library('session');
	}

	public function VerificarCuentaSocios_post() {

		$data = $this->post();

		if(!isset($data['login']) OR !isset($data['password'])) {

			$respuesta = array(
				'error' => TRUE,
				'mensaje' => 'Faltan Datos en el POST');
			$this->response($respuesta, REST_Controller::HTTP_BAD_REQUEST);
			return;
		}
		//Encriptar Clave en MD5
		$data['password'] = md5($data['password']);

		$condicion = array(
			'login' => $data['login'],
			'password' => $data['password'],
		);
		$query = $this->db->get_where('res_users', $condicion);

		$cuenta = $query->row();

		if(!isset($cuenta)) {

			$respuesta = array(
				'error' => TRUE,
				'mensaje' => 'Usuario o Clave son Incorrectos'
			);
			$this->response($respuesta);
			return;

		}

		//Existe Usuario y Clave en BD, Entonces Generar Token Aleatorio
		$token = $this->GenerarToken();

		//Actualizar Token y Asignarle un vencimiento o el tiempo para que expire
		$update = $this->db->query("UPDATE res_users SET signature='{$token}', 
			write_date = NOW() + interval '5 HOUR'
			WHERE id = {$cuenta->id}");

		//Si se ejecutó la sentencia correctamente
		if($update) {

			//Comprobar Si existe Nuevamente el Email y la Clave, pero ahora con el token

			/*$query = $this->db->query("SELECT * FROM res_users WHERE 
				login = '{$data['login']}' AND password = '{$data['password']}'
				AND signature = '{$token}' AND write_date > NOW()");*/
			$condicion = array(
				'login' => $data['login'],
				'password' => $data['password'],
				'signature' => $token,
			);
			$query = $this->db->get_where('res_users', $condicion);

			$cuenta = $query->row();

			if(!isset($cuenta)) {
				$respuesta = array(
					'error' => TRUE,
					'mensaje' => 'Usuario o Clave son Incorrectos'
				);
				$this->response($respuesta);
				return;
			}
			//TODO BIEN CON LA CUENTA
			$this->response($cuenta);
			
		}

		
		//$this->response($this->GenerarToken());


		//$token = bin2hex(openssl_random_pseudo_bytes(20));
		//$token = hash('ripemd160', $data['usuario']);
		//$this->response($token);
		//$this->response($this->db->get('res_users')->result());
	}
	public function EstaLogueado_get() {

		if($this->session->socio) {

			$this->response($this->session->socio);

		}
		/*if(isset($_SESSION['socio'])) {

			$this->response($_SESSION['socio']);

		}*/
		else {
			$respuesta = array(
				'error' => TRUE,
				'mensaje' => 'No está Logueado'
			);
			$this->response($respuesta);
		}

	}
	public function GenerarToken() {
        $str = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890";
        $password = "";
        for($i=0;$i<3;$i++) {
            $password .= md5(substr($str,rand(0,62),1));
        }
        $token=$password.time().md5(time()-100);
        return $token;
    }
	public function RegistrarUsuario_post(){
		$data = $this->post();
		if(!isset($data['usuario']) OR !isset($data['clave'])) {
			$respuesta = array(
				'error' => TRUE,
				'mensaje' => 'La informacion enviada no es válida');
			$this->response($respuesta, REST_Controller::HTTP_BAD_REQUEST);
			return;
		}
		$condicion = array(
			'usuario' => $data['usuario'],
			'clave' => $data['clave'],
		);
		$query = $this->db->get_where('login', $condicion);
		$usuario = $query->row();
		if(isset($usuario)) {
			//Existe Usuario y Clave en BD
			$respuesta = array(
				'error' => TRUE, 
				'mensaje' => 'Cuenta ya Existente'
			);
			$this->response($respuesta);
			return;
		}
		//Se puede Registrar Usuario y Clave
		$insertar = array(
			'usuario' => $data['usuario'],
			'clave' => $data['clave'],
		);
		$this->db->insert('login', $insertar);
		$respuesta = array(
			'error' => FALSE,
			'mensaje' => 'Cuenta Registrada Correctamente',
			'usuario' => $data['usuario'],
			'clave' => $data['clave'],
		);
		$this->response($respuesta);
	}
}
