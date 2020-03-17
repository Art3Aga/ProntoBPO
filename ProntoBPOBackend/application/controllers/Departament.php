<?php

/*if (!defined('BASEPATH'))
   exit('No direct script access allowed');*/
defined('BASEPATH') OR exit('No direct script access allowed');
require_once(APPPATH.'/libraries/REST_Controller.php');
use Restserver\libraries\REST_Controller;

class Departament extends REST_Controller {

   public function __construct() {
      header('Access-Control-Allow-Origin: *');
      header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
      header('Content-Type: application/json');
      header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
      header("Allow: GET, POST, OPTIONS, PUT, DELETE, HEAD");
      parent::__construct();
      $this->load->database();
      $this->load->model("Departament_model");
   }

    public function index_get() {
      //$data['datos'] = json_encode($this->Departament_model->obtener_todos());
      //$data['idd'] = $this->Employee_model->getId();
      //$resu = $this->Employee_model->obtener_todos();
      //$data['datos'] = $resu;
      //$this->load->view('xxx',$data);
    }

    public function ObtenerTodosDepartamentos_get($token = 0) {

      if($token == 0) {

        $respuesta = array(
            'error' => TRUE,
            'mensaje' => 'Falta Enviar el Token'
        );
        $this->response($respuesta);
      }
      
      $tokenValido = $this->Departament_model->isTokenValido($token);

      if($tokenValido) {

        $this->response($this->Departament_model->obtener_todos());

      }
      else {

        $respuesta = array(
          'error' => TRUE,
          'mensaje' => 'Token Invalido o Expirado, INICIE SESION NUEVAMENTE'
        );
        $this->response($respuesta);
      }

   }

   public function ObtenerEmpleadosPorDepartamentos_get($token = 0, $department_id = 0, $nombre_empleado = '') {

      if($token == 0 || $department_id == 0) {

        $respuesta = array(
            'error' => TRUE,
            'mensaje' => 'Falta Enviar el Token'
        );
        $this->response($respuesta);
      }
      
      $tokenValido = $this->Departament_model->isTokenValido($token);

      if($tokenValido) {
        
        $this->response(
          $this->Departament_model->obtener_empleados_por_departamento($department_id, $nombre_empleado)
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



   public function BuscarDepartamentos_get($token = 0, $department_id = 0) {

      if($token == 0 || $department_id == 0) {

        $respuesta = array(
            'error' => TRUE,
            'mensaje' => 'Falta Enviar el Token'
        );
        $this->response($respuesta);
      }
      
      $tokenValido = $this->Departament_model->isTokenValido($token);

      if($tokenValido) {
        
        $this->response(
          $this->Departament_model->buscar_departamentos($department_id)
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
}
?>