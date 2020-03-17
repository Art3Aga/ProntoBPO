<?php

/*if (!defined('BASEPATH'))
   exit('No direct script access allowed');*/
defined('BASEPATH') OR exit('No direct script access allowed');
require_once(APPPATH.'/libraries/REST_Controller.php');
use Restserver\libraries\REST_Controller;

class Jobs extends REST_Controller {

   public function __construct() {
      header('Access-Control-Allow-Origin: *');
      header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
      header('Content-Type: application/json');
      header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
      header("Allow: GET, POST, OPTIONS, PUT, DELETE, HEAD");
      parent::__construct();
      $this->load->database();
      $this->load->model("Jobs_model");
   }

    public function index_get() {
      //$data['datos'] = json_encode($this->Jobs_model->obtener_todos());
      //$data['idd'] = $this->Employee_model->getId();
      //$resu = $this->Employee_model->obtener_todos();
      //$data['datos'] = $resu;
      //$this->load->view('xxx',$data);
    }

    public function ObtenerTodosPuestos_get($token = 0) {

      if($token == 0) {

        $respuesta = array(
            'error' => TRUE,
            'mensaje' => 'Falta Enviar el Token'
        );
        $this->response($respuesta);
      }
      
      $tokenValido = $this->Jobs_model->isTokenValido($token);

      if($tokenValido) {

        $this->response($this->Jobs_model->obtener_todos());

      }
      else {

        $respuesta = array(
          'error' => TRUE,
          'mensaje' => 'Token Invalido o Expirado, INICIE SESION NUEVAMENTE'
        );
        $this->response($respuesta);
      }

   }

   public function ObtenerEmpleadosPorPuesto_get($token = 0, $job_id = 0, $nombre_empleado = '') {

      if($token == 0 || $job_id == 0) {

        $respuesta = array(
            'error' => TRUE,
            'mensaje' => 'Falta Enviar el Token'
        );
        $this->response($respuesta);
      }
      
      $tokenValido = $this->Jobs_model->isTokenValido($token);

      if($tokenValido) {
        
        $this->response(
          $this->Jobs_model->obtener_empleados_por_puesto($job_id, $nombre_empleado)
        );

      }
      else {

        $respuesta = array(
          'error' => TRUE,
          'mensaje' => 'Token Invalido o Expirado, INICIE SESION NUEVAMENTE'
        );
        $this->response($respuesta);
      }

   }


   public function BuscarPuestosPorEmpleado_get($token = 0, $job_id = 0, $nombre_empleado = '') {

      if($token == 0 || $job_id == 0) {

        $respuesta = array(
            'error' => TRUE,
            'mensaje' => 'Falta Enviar el Token'
        );
        $this->response($respuesta);
      }
      
      $tokenValido = $this->Jobs_model->isTokenValido($token);

      if($tokenValido) {
        
        $this->response(
          $this->Jobs_model->buscar_puestos_por_empleado($job_id, $nombre_empleado)
        );

      }
      else {

        $respuesta = array(
          'error' => TRUE,
          'mensaje' => 'Token Invalido o Expirado, INICIE SESION NUEVAMENTE'
        );
        $this->response($respuesta);
      }

   }

   public function BuscarPuestos_get($token = 0, $job_id = 0) {

      if($token == 0 || $job_id == 0) {

        $respuesta = array(
            'error' => TRUE,
            'mensaje' => 'Falta Enviar el Token'
        );
        $this->response($respuesta);
      }
      
      $tokenValido = $this->Jobs_model->isTokenValido($token);

      if($tokenValido) {
        
        $this->response(
          $this->Jobs_model->buscar_puesto($job_id)
        );

      }
      else {

        $respuesta = array(
          'error' => TRUE,
          'mensaje' => 'Token Invalido o Expirado, INICIE SESION NUEVAMENTE'
        );
        $this->response($respuesta);
      }

   }

   public function VistasPorPuesto_get($token = 0, $job_id = 0) {

      if($token == 0) {

        $respuesta = array(
            'error' => TRUE,
            'mensaje' => 'Falta Enviar el Token'
        );
        $this->response($respuesta);
      }

      $tokenValido = $this->Jobs_model->isTokenValido($token);

      if($tokenValido) {

        $contador = $this->Jobs_model->ObtenerVistasPorPuesto($job_id);
        $this->response($contador);
        /*if($contador == 1) {
          $this->response('0');
        }
        else {
         $this->response($contador);
        }*/
      }
      else {

        $respuesta = array(
          'error' => TRUE,
          'mensaje' => 'Token Invalido o Expirado, INICIE SESION NUEVAMENTE'
        );
        $this->response($respuesta);
      }

   }

   public function TodasVistasPuesto_get($token = 0) {

      if($token == 0) {

        $respuesta = array(
            'error' => TRUE,
            'mensaje' => 'Falta Enviar el Token'
        );
        $this->response($respuesta);
      }

      $tokenValido = $this->Jobs_model->isTokenValido($token);

      if($tokenValido) {
        $this->response($this->Jobs_model->ObtenerContadorVistasPuesto());
      }
      else {

        $respuesta = array(
          'error' => TRUE,
          'mensaje' => 'Token Invalido o Expirado, INICIE SESION NUEVAMENTE'
        );
        $this->response($respuesta);
      }

   }


   public function ActualizarVistasPorPuesto_get($token = 0, $job_id = 0, $contador_vistas = 0) {

      if($token == 0) {

        $respuesta = array(
            'error' => TRUE,
            'mensaje' => 'Falta Enviar el Token'
        );
        $this->response($respuesta);
      }

      $tokenValido = $this->Jobs_model->isTokenValido($token);

      if($tokenValido) {

        $actualizar = $this->Jobs_model->UpdateVistasPorPuesto($job_id, $contador_vistas);
        $this->response($actualizar);
      }
      else {

        $respuesta = array(
          'error' => TRUE,
          'mensaje' => 'Token Invalido o Expirado, INICIE SESION NUEVAMENTE'
        );
        $this->response($respuesta);
      }

   }
}
?>