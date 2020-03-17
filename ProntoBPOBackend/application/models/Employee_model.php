<?php
class Employee_model extends CI_Model { 

   public function __construct() {
      parent::__construct();
      $this->load->database();
   }

   public function obtener_todos(){
    $query = $this->db->query('SELECT hr_employee.id as id_employee, hr_employee.name, hr_employee.gender, hr_employee.marital, hr_employee.job_title, hr_employee.work_phone, hr_employee.mobile_phone,
        hr_employee.work_email, hr_employee.work_location, hr_employee.department_id, hr_department.name as department, hr_job.name as job_name, hr_job.id as job_id
        FROM hr_employee INNER JOIN hr_department ON hr_department.id = hr_employee.department_id INNER JOIN hr_job ON hr_job.id = hr_employee.job_id ;');
    $resultado = $query->result();
    return $resultado;
  }

  public function existeVistadeEmpleado($id_empleado = '') {

    $query = $this->db->query("SELECT coach_id FROM hr_employee WHERE id = {$id_empleado}");

    $resultado = $query->row();

    return $resultado->coach_id;
  }
  public function buscar_empleado_todos($empleado_name = ''){
    $query = $this->db->query("SELECT hr_employee.id as id_employee, hr_employee.name, hr_employee.gender, hr_employee.marital, hr_employee.job_title, hr_employee.work_phone, hr_employee.mobile_phone,
        hr_employee.work_email, hr_employee.work_location, hr_employee.department_id, hr_department.name as department, hr_job.name as job_name, hr_job.id as job_id,
        hr_job.address_id
        FROM hr_employee INNER JOIN hr_department ON hr_department.id = hr_employee.department_id INNER JOIN hr_job ON hr_job.id = hr_employee.job_id 
        WHERE LOWER(hr_employee.name) LIKE LOWER('{$empleado_name}%');");
    $resultado = $query->result();
    return $resultado;
  }
  public function buscar_empleado_departamento($empleado_name = ''){
    $query = $this->db->query("SELECT hr_department.name, hr_department.id, hr_job.address_id
        FROM hr_employee INNER JOIN hr_department ON hr_department.id = hr_employee.department_id INNER JOIN hr_job ON hr_job.id = hr_employee.job_id 
        WHERE LOWER(hr_employee.name) LIKE LOWER('{$empleado_name}%');");
    $resultado = $query->result();
    return $resultado;
  }
  public function buscar_empleado_puesto($empleado_name = ''){
    /*$query = $this->db->query("SELECT hr_department.name, hr_department.id
        FROM hr_employee INNER JOIN hr_department ON hr_department.id = hr_employee.department_id INNER JOIN hr_job ON hr_job.id = hr_employee.job_id 
        WHERE LOWER(hr_employee.name) LIKE LOWER('{$empleado_name}%');");*/
    $query = $this->db->query("SELECT hr_job.name, hr_job.id, hr_job.address_id
        FROM hr_employee INNER JOIN hr_department ON hr_department.id = hr_employee.department_id INNER JOIN hr_job ON hr_job.id = hr_employee.job_id 
        WHERE LOWER(hr_employee.name) LIKE LOWER('{$empleado_name}%');");

    $resultado = $query->result();
    return $resultado;
  }
  public function isTokenValido($token = 0) {
    
    $query = $this->db->query("SELECT * FROM res_users WHERE signature = '{$token}' 
      AND write_date > NOW()");

    $cuenta = $query->row();

    if(!isset($cuenta)) {

      return false;
      
    }
    return true;

  }

  public function UpdateVistasEmpleado($id_employee = 0, $vistas = 0) {

    $query = $this->db->query("UPDATE hr_employee SET coach_id = {$vistas}
      WHERE id = {$id_employee}");

    if($query) {

      $respuesta = array(
        'error' => FALSE,
        'mensaje' => 'N° de Vistas del Empleado Actualizadas Correctamente'
      );
      return $respuesta;
    }
    else {
      $respuesta = array(
        'error' => TRUE,
        'mensaje' => 'Error al Actualizar Vistas del Puesto de Trabajo'
      );
      return $respuesta;
    }

  }

 public function guardar($name, $id=null){
    //$ultimo = $this->getId();
   $data = array(
      'name' => $name,
      'resource_id' => 20
   );

      $this->db->insert('hr_employee', $data);
 
 }




}
?>