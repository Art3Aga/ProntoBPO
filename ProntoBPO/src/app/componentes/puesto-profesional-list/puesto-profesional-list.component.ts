import { ProfesionalModel } from './../../modelos/profesionalModel';
import { PuestosModel } from './../../modelos/puestosModel';
import { ProfesionalController } from './../../controladores/profesional-controller.service';
import { AccionesService } from './../../servicios/acciones.service';
import { Component, OnInit, Input } from '@angular/core';

@Component({
  selector: 'app-puesto-profesional-list',
  templateUrl: './puesto-profesional-list.component.html',
  styleUrls: ['./puesto-profesional-list.component.scss']
})
export class PuestoProfesionalListComponent implements OnInit {

  @Input() puesto: PuestosModel;
  @Input() isItem: boolean;
  @Input() nombre_empleado: string;
  listaProfesionales: ProfesionalModel[];

  constructor(public profesionalController: ProfesionalController,
    public acciones: AccionesService) { }

  ngOnInit() {
    this.ObtenerEmpleadosPuesto();
  }

  ObtenerEmpleadosPuesto() {
    this.profesionalController.AgruparEmpleadosPorPuesto(this.puesto.id, this.nombre_empleado).subscribe(
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
