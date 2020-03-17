<?php
class Departament_model extends CI_Model { 

   public function __construct() {
    header('Access-Control-Allow-Origin: *');
    header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
    header('Content-Type: application/json');
    header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
    header("Allow: GET, POST, OPTIONS, PUT, DELETE, HEAD");
      parent::__construct();
      $this->load->database();
   }

  public function obtener_todos(){
    $this->db->select('name, id');
    $this->db->from('hr_department');
    //$this->db->order_by('titulo', 'asc');
    $consulta = $this->db->get();
    $resultado = $consulta->result();
    return $resultado;
  }
  public function buscar_departamentos($department_id = 0){
    $consulta = $this->db->query("SELECT id,name FROM hr_department 
      WHERE id = {$department_id}");
    $resultado = $consulta->result();
    return $resultado;
  }
  public function obtener_empleados_por_departamento($department_id = 0, $nombre_empleado = '') {

    /*$consulta = $this->db->query("SELECT hr_employee.id as id_employee, hr_employee.name, hr_employee.gender, hr_employee.marital, hr_employee.job_title, hr_employee.work_phone, hr_employee.mobile_phone,
        hr_employee.work_email, hr_employee.work_location, hr_employee.department_id,hr_department.name as department
        FROM hr_employee INNER JOIN hr_department ON hr_department.id = hr_employee.department_id WHERE department_id = {$department_id}");*/
  $consulta = $this->db->query("SELECT hr_employee.id as id_employee, hr_employee.name, hr_employee.gender, hr_employee.marital, hr_employee.job_title, hr_employee.work_phone, hr_employee.mobile_phone, hr_job.address_id,
        hr_employee.work_email, hr_employee.work_location, hr_employee.department_id, hr_department.name as department, hr_job.name as job_name, hr_job.id as job_id
        FROM hr_employee INNER JOIN hr_department ON hr_department.id = hr_employee.department_id INNER JOIN hr_job ON hr_job.id = hr_employee.job_id 
        WHERE LOWER(hr_employee.name) LIKE LOWER('{$nombre_empleado}%') AND hr_employee.department_id = {$department_id}");

    $data = $consulta->result();

    return $data;

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

}
?>