<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title></title>
	<link rel="stylesheet" href="">
	<!--Bootstrap-->
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <!--ChartJS-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.js"></script>
</head>
<body>
	<?php 
		date_default_timezone_set('America/Tegucigalpa');
		header('Access-Control-Allow-Origin: *');
	    header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
	    header('Content-Type: application/json');
	    header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
	    header("Allow: GET, POST, OPTIONS, PUT, DELETE, HEAD");


	    try {

	    	$conexionBD = pg_connect("host=localhost port=5432 dbname=Prueba1 user=openpg password=openpgpwd");

	    	//pg_fetch_assoc = primer registro
	    	$resultado = pg_query($conexionBD, "SELECT hr_employee.id as id_employee, hr_employee.name, hr_employee.gender, hr_employee.marital, hr_employee.job_title, hr_employee.work_phone, hr_employee.mobile_phone,
        	hr_employee.work_email, hr_employee.work_location, hr_employee.department_id, hr_department.name as department, hr_job.name as job_name, hr_job.id as job_id
        	FROM hr_employee INNER JOIN hr_department ON hr_department.id = hr_employee.department_id INNER JOIN hr_job ON hr_job.id = hr_employee.job_id");

	    	$todos = pg_fetch_all($resultado);


	    	
        	$resultado3 = pg_query($conexionBD, "SELECT * FROM hr_department");

        	$departamentos = pg_fetch_all($resultado3);

        	$resultado4 = pg_query($conexionBD, "SELECT * FROM hr_job");

        	$puestos = pg_fetch_all($resultado4);


	    } catch (PDOException $e) {

	    	echo "Error : " . $e->getMessage() . "<br/>";
			die();

	    }

	    function GetEmpleadosPorDepa($id_depa = 0) {

	    	$conexionBD = pg_connect("host=localhost port=5432 dbname=Prueba1 user=openpg password=openpgpwd");

	    	$resultado2 = pg_query($conexionBD, "SELECT hr_employee.id as id_employee, hr_employee.name, hr_employee.gender, hr_employee.marital, hr_employee.job_title, hr_employee.work_phone, hr_employee.mobile_phone,
        	hr_employee.work_email, hr_employee.work_location, hr_employee.department_id, hr_department.name as department, hr_job.name as job_name, hr_job.id as job_id
        	FROM hr_employee INNER JOIN hr_department ON hr_department.id = hr_employee.department_id INNER JOIN hr_job ON hr_job.id = hr_employee.job_id
        	WHERE hr_employee.department_id = {$id_depa}");

        	$empleados_por_departamento = pg_fetch_all($resultado2);

        	return $empleados_por_departamento;
		}

		function GetEmpleadosPorPuesto($id_puesto = 0) {

	    	$conexionBD = pg_connect("host=localhost port=5432 dbname=Prueba1 user=openpg password=openpgpwd");

	    	$resultado2 = pg_query($conexionBD, "SELECT hr_employee.id as id_employee, hr_employee.name, hr_employee.gender, hr_employee.marital, hr_employee.job_title, hr_employee.work_phone, hr_employee.mobile_phone,
        	hr_employee.work_email, hr_employee.work_location, hr_employee.department_id, hr_department.name as department, hr_job.name as job_name, hr_job.id as job_id
        	FROM hr_employee INNER JOIN hr_department ON hr_department.id = hr_employee.department_id INNER JOIN hr_job ON hr_job.id = hr_employee.job_id
        	WHERE hr_job.id = {$id_puesto}");

        	$empleados_por_puesto = pg_fetch_all($resultado2);

        	return $empleados_por_puesto;
		}
	 ?>
	<style type="text/css" media="screen">

		.img-logo img{
			/*float: right;*/
			width: 300px;
			height: 200px;
		}
		.img-logo {
			
			text-align: center;
		}
		.header h2{
			text-align: center;
		}
		.header {
			
		}
		
		#tabla-empleados {
		  border-collapse: collapse;
		  width: 100%;
		  border-spacing: 0;
		}

		#tabla-empleados td, #tabla-empleados th {
		  border: 1px solid #ddd;
		  padding: 8px;
		  text-align: left;
		  font-size: 13px;
		}

		#tabla-empleados tr:nth-child(even){background-color: #f2f2f2;}

		#tabla-empleados tr:hover {background-color: #ddd;}

		#tabla-empleados th {
		  padding-top: 12px;
		  padding-bottom: 12px;
		  text-align: left;
		  background-color: #f18426;
		  color: white;
		}
		.table-responsive {
			overflow-x: auto;
		}

	</style>
	<div class="header">
		<h2 class="text-center">Listado de Empleados</h2>
		<p><?php echo 'San Miguel, El Salvador, ' .date('d/m/Y h:i:s a'); ?></p>
		<b>PRONTO BPO</b>
	</div>
	<div class="img-logo">
		<img src="http://192.168.1.7:80/ProntoBPOBackend/Imgs/prontobpo.png" alt="">
	</div>



	<!--TODOS-->

	<h3>TODOS LOS EMPLEADOS</h3>
	<div class="table-responsive">
      <table class="table table-bordered" id="tabla-empleados" border="1">
        <thead class="danger">
          <tr>
            <th scope="col">Nombre del Empleado</th>
            <th scope="col">Numero de Telefono</th>
            <th scope="col">Puesto</th>
            <th scope="col">Departamento</th>
          </tr>
        </thead>
        <tbody>
        	<?php foreach($todos as $empleado): ?>
        		<tr>
			        <td><?php echo htmlspecialchars($empleado['name']); ?></td>
			        <td><?php echo htmlspecialchars($empleado['work_phone']); ?></td>
			        <td><?php echo htmlspecialchars($empleado['job_name']); ?></td>
			        <td><?php echo htmlspecialchars($empleado['department']); ?></td>
			    </tr>
			<?php endforeach; ?>
        </tbody>
      </table>
    </div>
    <p>Total Empleados: <?php echo count($todos); ?></p>
    <br><hr>
    <br>

    <!--POR PUESTO-->

	<h3>POR PUESTO</h3>
    <div class="depas">
    	<?php foreach($puestos as $job): ?>
    		<!--<h4><?php echo htmlspecialchars($depa['name']); ?></h4>-->
    		<h4><?php echo 'Puesto de '. htmlspecialchars($job['name']); ?></h4>
			<div class="table-responsive">
		      <table class="table table-bordered" id="tabla-empleados" border="1">
		        <thead class="danger">
		          <tr>
		            <th scope="col">Nombre del Empleado</th>
		            <th scope="col">Numero de Telefono</th>
		            <th scope="col">Email</th>
		            <th scope="col">Ubicacion de Trabajo</th>
		          </tr>
		        </thead>
		        <tbody>
		        	<?php foreach((array)GetEmpleadosPorPuesto($job['id']) as $empleado): ?>
		        		<tr>
					        <td><?php echo htmlspecialchars($empleado['name']); ?></td>
					        <td><?php echo htmlspecialchars($empleado['work_phone']); ?></td>
					        <td><?php echo htmlspecialchars($empleado['work_email']); ?></td>
					        <td><?php echo htmlspecialchars($empleado['work_location']); ?></td>
					    </tr>
					<?php endforeach; ?>
		        </tbody>
		      </table>
		    </div>
		    <br><hr>
		    <br>
		    <p>Total Empleados: <?php echo count(GetEmpleadosPorPuesto($job['id'])); ?></p>
    	<?php endforeach; ?>
    </div>


    <!--POR DEPARTAMENTO-->


    <h3>POR DEPARTAMENTO</h3>
    <div class="depas">
    	<?php foreach($departamentos as $depa): ?>
    		<!--<h4><?php echo htmlspecialchars($depa['name']); ?></h4>-->
    		<h4><?php echo 'Departamento de '. htmlspecialchars($depa['name']); ?></h4>
			<div class="table-responsive">
		      <table class="table table-bordered" id="tabla-empleados" border="1">
		        <thead class="danger">
		          <tr>
		            <th scope="col">Nombre del Empleado</th>
		            <th scope="col">Numero de Telefono</th>
		            <th scope="col">Email</th>
		            <th scope="col">Ubicacion de Trabajo</th>
		          </tr>
		        </thead>
		        <tbody>
		        	<?php foreach(GetEmpleadosPorDepa($depa['id']) as $empleado): ?>
		        		<tr>
					        <td><?php echo htmlspecialchars($empleado['name']); ?></td>
					        <td><?php echo htmlspecialchars($empleado['work_phone']); ?></td>
					        <td><?php echo htmlspecialchars($empleado['work_email']); ?></td>
					        <td><?php echo htmlspecialchars($empleado['work_location']); ?></td>
					    </tr>
					<?php endforeach; ?>
		        </tbody>
		      </table>
		    </div>
		    <br><hr>
		    <br>
		    <p>Total Empleados: <?php echo count(GetEmpleadosPorDepa($depa['id'])); ?></p>
    	<?php endforeach; ?>
    </div>

</body>
</html>
