import { ProfesionalModel } from './../../modelos/profesionalModel';
import { AccionesService } from './../../servicios/acciones.service';
import { DepartamentoModel } from './../../modelos/departamentoModel';
import { ProfesionalController } from './../../controladores/profesional-controller.service';
import { Component, OnInit, Input } from '@angular/core';

@Component({
  selector: 'app-depart-profesional-list',
  templateUrl: './depart-profesional-list.component.html',
  styleUrls: ['./depart-profesional-list.component.scss']
})
export class DepartProfesionalListComponent implements OnInit {

  @Input() departamento: DepartamentoModel;
  @Input() isItem: boolean;
  @Input() nombre_empleado: string;
  listaProfesionales: ProfesionalModel[];

  constructor(
    public profesionalController: ProfesionalController,
    public acciones: AccionesService) { }

  ngOnInit() {
    this.ObtenerEmpleadosPorDepartamento();
  }

  ObtenerEmpleadosPorDepartamento() {
    this.profesionalController.AgruparEmpleadosPorDepartamento(this.departamento.id, this.nombre_empleado).subscribe(
      data => {
        if(data['error']) {
          this.acciones.ShowMensaje(data['mensaje'], '', 9000, 'bad', 'bottom');
          this.profesionalController.setIsError = true;
          this.profesionalController.setMensajeError = data['mensaje'];
        }
        else {
          this.listaProfesionales = data;
          this.profesionalController.setIsError = false;
          this.profesionalController.setMensajeError = '';
        }
      },
      error => console.log(error),
    );
  }

}
