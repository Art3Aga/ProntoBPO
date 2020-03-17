import { Component, OnInit, Input } from '@angular/core';
import { ProfesionalModel } from 'src/app/modelos/profesionalModel';

@Component({
  selector: 'app-item-profesional',
  templateUrl: './item-profesional.component.html',
  styleUrls: ['./item-profesional.component.scss']
})
export class ItemProfesionalComponent implements OnInit {


  @Input() foto: string;
  @Input() puesto: string;
  @Input() empleado: ProfesionalModel;
  //@Input() nombreEmpleado: string;
  //@Input() calificacion: number;
  //@Input() titulo: string;
  @Input() isItem: boolean;

  listaEstrellas: any[] = []

  constructor() { }

  ngOnInit() {
    //this.validarImagenCalificacion()
  }

  /*validarImagenCalificacion() {
    if(this.calificacion === 1) {
      //this.imagenEstrella = '../../../assets/estrella1.png'
      this.listaEstrellas.length = 1
    }
    else if(this.calificacion === 2) {
      //this.imagenEstrella = '../../../assets/estrella2.png'
      this.listaEstrellas.length = 2
    }
    else if(this.calificacion === 3) {
      //this.imagenEstrella = '../../../assets/estrella3.png'
      this.listaEstrellas.length = 3
    }
  }*/

}
