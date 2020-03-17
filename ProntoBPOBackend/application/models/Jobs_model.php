<?php
class Jobs_model extends CI_Model { 

   public function __construct() {
      parent::__construct();
      $this->load->database();
   }


  public function obtener_todos() {
    $this->db->select('id,name,description,requirements,state,address_id');
    $this->db->from('hr_job');
    $consulta = $this->db->get();
    $resultado = $consulta->result();
    return $resultado;
  }

  public function buscar_puesto($job_id = 0) {
    $consulta = $this->db->query("SELECT id,name,description,requirements,state,address_id
      FROM hr_job WHERE id = {$job_id}");
    //$this->db->select('id,name,description,requirements,state');
    //$this->db->from('hr_job');
    //$consulta = $this->db->get();
    $resultado = $consulta->result();
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

  public function obtener_empleados_por_puesto($job_id = 0, $nombre_empleado = '') {

    /*$consulta = $this->db->query("SELECT hr_employee.id as id_employee, hr_employee.name, hr_employee.gender, hr_employee.marital, hr_employee.job_title, hr_employee.work_phone, hr_employee.mobile_phone,
        hr_employee.work_email, hr_employee.work_location, hr_employee.department_id, hr_department.name as department, hr_job.name as job_name, hr_job.id as job_id
        FROM hr_employee INNER JOIN hr_department ON hr_department.id = hr_employee.department_id INNER JOIN hr_job ON hr_job.id = hr_employee.job_id  WHERE
        hr_employee.job_id = {$job_id};");*/
    $consulta = $this->db->query("SELECT hr_employee.id as id_employee, hr_employee.name, hr_employee.gender, hr_employee.marital, hr_employee.job_title, hr_employee.work_phone, hr_employee.mobile_phone, hr_job.address_id,
        hr_employee.work_email, hr_employee.work_location, hr_employee.department_id, hr_department.name as department, hr_job.name as job_name, hr_job.id as job_id
        FROM hr_employee INNER JOIN hr_department ON hr_department.id = hr_employee.department_id INNER JOIN hr_job ON hr_job.id = hr_employee.job_id 
        WHERE LOWER(hr_employee.name) LIKE LOWER('{$nombre_empleado}%') AND hr_employee.job_id = {$job_id};");

    $data = $consulta->result();

    return $data;

  }

  public function buscar_puestos_por_empleado($job_id = 0, $nombre_empleado = '') {

    $consulta = $this->db->query("SELECT hr_employee.id as id_employee, hr_employee.name,
     hr_employee.gender, hr_employee.marital, hr_employee.job_title, hr_employee.work_phone, hr_employee.mobile_phone, hr_job.address_id,
        hr_employee.work_email, hr_employee.work_location, hr_employee.department_id, hr_department.name as department, hr_job.name as job_name, hr_job.id as job_id
        FROM hr_employee INNER JOIN hr_department ON hr_department.id = hr_employee.department_id INNER JOIN hr_job ON hr_job.id = hr_employee.job_id 
        WHERE LOWER(hr_employee.name) LIKE LOWER('{$nombre_empleado}%') AND hr_employee.job_id = {$job_id};");

    $data = $consulta->result();

    return $data;

  }

  public function ObtenerContadorVistasPuesto() {

    $query = $this->db->query("SELECT id, name, address_id FROM hr_job");

    $resultado = $query->result();

    return $resultado;

  }

  public function ObtenerVistasPorPuesto($job_id = 0) {

    $query = $this->db->query("SELECT address_id FROM hr_job WHERE id = {$job_id}");

    $resultado = $query->row();

    return $resultado->address_id;
  }

  public function UpdateVistasPorPuesto($job_id = 0, $contador_vistas = 0) {

    $query = $this->db->query("UPDATE hr_job SET address_id = {$contador_vistas}
      WHERE id = {$job_id}");

    if($query) {

      $respuesta = array(
        'error' => FALSE,
        'mensaje' => 'N° de Vistas del Puesto de Trabajo Actualizadas Correctamente'
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

}
?>