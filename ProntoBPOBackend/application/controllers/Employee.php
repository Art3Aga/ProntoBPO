<?php
/*if (!defined('BASEPATH'))
   exit('No direct script access allowed');*/
defined('BASEPATH') OR exit('No direct script access allowed');
require_once(APPPATH.'/libraries/REST_Controller.php');
use Restserver\libraries\REST_Controller;

class Employee extends REST_Controller {
   public function __construct() {

      /*header("Access-Control-Allow-Methods: PUT, GET, POST, DELETE, OPTIONS");
      header("Access-Control-Allow-Headers: Content-Type, Content-Length, Accept-Encoding");
      header("Access-Control-Allow-Origin: *");*/
      header('Access-Control-Allow-Origin: *');
    header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
    header('Content-Type: application/json');
    header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
    header("Allow: GET, POST, OPTIONS, PUT, DELETE, HEAD");
      parent::__construct();
      $this->load->database();
      $this->load->model("Employee_model");
   }

   /*public function index_get(){
       $data['datos'] = json_encode($this->Employee_model->obtener_todos());
       //$data['idd'] = $this->Employee_model->getId();
       //$resu = $this->Employee_model->obtener_todos();
       //$data['datos'] = $resu;
       //$this->load->view('xxx',$data);
   }*/

   public function ObtenerTodosEmpleados_get($token = 0) {

      if($token == 0) {

        $respuesta = array(
            'error' => TRUE,
            'mensaje' => 'Falta Enviar el Token'
        );
        $this->response($respuesta);
      }

      $tokenValido = $this->Employee_model->isTokenValido($token);

      if($tokenValido) {

        $this->response($this->Employee_model->obtener_todos());

      }
      else {

        $respuesta = array(
          'error' => TRUE,
          'mensaje' => 'Token Invalido o Expirado, INICIE SESION NUEVAMENTE'
        );
        $this->response($respuesta);
      }

   }

   public function BuscarEmpleadosTodos_get($token = 0, $empleado_name = '') {

      if($token == 0) {

        $respuesta = array(
            'error' => TRUE,
            'mensaje' => 'Falta Enviar el Token'
        );
        $this->response($respuesta);
      }

      $tokenValido = $this->Employee_model->isTokenValido($token);

      if($tokenValido) {

        $this->response($this->Employee_model->buscar_empleado_todos($empleado_name));

      }
      else {

        $respuesta = array(
          'error' => TRUE,
          'mensaje' => 'Token Invalido o Expirado, INICIE SESION NUEVAMENTE'
        );
        $this->response($respuesta);
      }

   }


   public function BuscarEmpleadosDepartamento_get($token = 0, $empleado_name = '') {

      if($token == 0) {

        $respuesta = array(
            'error' => TRUE,
            'mensaje' => 'Falta Enviar el Token'
        );
        $this->response($respuesta);
      }

      $tokenValido = $this->Employee_model->isTokenValido($token);

      if($tokenValido) {

        $this->response($this->Employee_model->buscar_empleado_departamento($empleado_name));

      }
      else {

        $respuesta = array(
          'error' => TRUE,
          'mensaje' => 'Token Invalido o Expirado, INICIE SESION NUEVAMENTE'
        );
        $this->response($respuesta);
      }

   }

   public function BuscarEmpleadosPuesto_get($token = 0, $empleado_name = '') {

      if($token == 0) {

        $respuesta = array(
            'error' => TRUE,
            'mensaje' => 'Falta Enviar el Token'
        );
        $this->response($respuesta);
      }

      $tokenValido = $this->Employee_model->isTokenValido($token);

      if($tokenValido) {

        $this->response($this->Employee_model->buscar_empleado_puesto($empleado_name));

      }
      else {

        $respuesta = array(
          'error' => TRUE,
          'mensaje' => 'Token Invalido o Expirado, INICIE SESION NUEVAMENTE'
        );
        $this->response($respuesta);
      }

   }


   public function ExisteVistadeEmpleado_get($token = 0, $id_empleado = 0) {

      if($token == 0) {

        $respuesta = array(
            'error' => TRUE,
            'mensaje' => 'Falta Enviar el Token'
        );
        $this->response($respuesta);
      }

      $tokenValido = $this->Employee_model->isTokenValido($token);

      if($tokenValido) {

        $contador = $this->Employee_model->existeVistadeEmpleado($id_empleado);
        $this->response($contador);
        /*if($contador <= 1) {
          $this->response($contador);  
        }
        else {
         $this->response('Cero');   
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



   public function ActualizarVistasEmpleado_get($token = 0, $id_empleado = 0, $vistas = 0) {

      if($token == 0) {

        $respuesta = array(
            'error' => TRUE,
            'mensaje' => 'Falta Enviar el Token'
        );
        $this->response($respuesta);
      }

      $tokenValido = $this->Employee_model->isTokenValido($token);

      if($tokenValido) {

        $actualizar = $this->Employee_model->UpdateVistasEmpleado($id_empleado, $vistas);
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




   public function guardar($id=null){
    if($this->input->post()){
       $titulo = $this->input->post('name');
       //$this->load->model('_model');
       $this->Employee_model->guardar($titulo,$id);
       redirect('Empleados');
    }else{
       $this->index();
    } 
  }


}
?>