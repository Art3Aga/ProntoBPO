//import { AccionesService } from './../servicios/acciones.service';
import { EncriptarService } from './../servicios/encriptar.service';
import { Observable } from 'rxjs';
import { ProfesionalModel } from './../modelos/profesionalModel';
import { CrudService } from './../servicios/crud.service';
import { Injectable } from '@angular/core';

@Injectable({
  providedIn: 'root'
})
export class ProfesionalController {


  //#region Atributos


  private _mensajeError : string = '';
  public get getMensajeError() : string {
    return this._mensajeError;
  }
  public set setMensajeError(nuevoMensaje : string) {
    this._mensajeError = nuevoMensaje;
  }

  private _isError : boolean = false;
  public get getIsError() : boolean {
    return this._isError;
  }
  public set setIsError(nuevoError : boolean) {
    this._isError = nuevoError;
  }

  private _cargando : boolean = false;
  public get getCargando() : boolean {
    return this._cargando;
  }
  public set setCargando(nuevoEstado : boolean) {
    this._cargando = nuevoEstado;
  }

  private _ListaProfesionales : ProfesionalModel[] = [];
  public get getListaProfesionales() : ProfesionalModel[] {
    return this._ListaProfesionales;
  }
  public set setListaProfesionales(nuevaLista : ProfesionalModel[]) {
    this._ListaProfesionales = nuevaLista;
  }

  //#endregion

  constructor(private crud: CrudService, private encriptarService: EncriptarService,
    /*private accionesService: AccionesService*/) {
  }


  //#region Metodos

    public ObtenerTodosProfesionales() {
      let usuario: any = JSON.parse(localStorage.getItem('socio'));
      let token:any = this.encriptarService.DesEncriptar(usuario['token']);
      this._cargando = true;
      this.crud.ObtenerTodosProfesionales(token).subscribe(
        data => {
          this._cargando = false;
          if(data['error']) {
            //this.accionesService.ShowMensaje(data['mensaje'], '', 9000, 'bad', 'bottom');
            this._isError = true;
            this._mensajeError = data['mensaje'];
          }
          else {
            this._ListaProfesionales = data;
            this._isError = false;
            this._mensajeError = '';
          }
        },
        error => console.log(error),
      );

    }

    public AgruparEmpleadosPorDepartamento(department_id: number, nombre_empleado: string): Observable<ProfesionalModel[]> {
      let usuario: any = JSON.parse(localStorage.getItem('socio'));
      let token:any = this.encriptarService.DesEncriptar(usuario['token']);
      return this.crud.AgruparProfesionalesPorDepartamento(token, department_id, nombre_empleado);
    }
    public AgruparEmpleadosPorPuesto(job_id: number, nombre_empleado: string): Observable<ProfesionalModel[]> {
      let usuario: any = JSON.parse(localStorage.getItem('socio'));
      let token:any = this.encriptarService.DesEncriptar(usuario['token']);
      return this.crud.AgruparProfesionalesPorPuesto(token, job_id, nombre_empleado);
    }
    public BuscarEmpleadosTodos(valor: any) {
      //let valor: string = event['target']['value'].toString();
      let usuario: any = JSON.parse(localStorage.getItem('socio'));
      let token:any = this.encriptarService.DesEncriptar(usuario['token']);
      this.crud.BuscarEmpleadosTodos(token, valor).subscribe(
        data => {
          this._cargando = false;
          if(data['error']) {
            //this.accionesService.ShowMensaje(data['mensaje'], '', 9000, 'bad', 'bottom');
            this._isError = true;
            this._mensajeError = data['mensaje'];
          }
          else {
            this._ListaProfesionales = data;
            this._isError = false;
            this._mensajeError = '';
          }
        },
        error => console.log(error),
      );
    }

    public ValidarVistaEmpleado(id_empleado: number): Observable<string> {
      let usuario: any = JSON.parse(localStorage.getItem('socio'));
      let token:any = this.encriptarService.DesEncriptar(usuario['token']);
      return this.crud.ExisteVistadeEmpleado(token, id_empleado);
    }

    public UpdateVistasEmpleado(id_empleado: number, n_vistas: number) {
      let usuario: any = JSON.parse(localStorage.getItem('socio'));
      let token:any = this.encriptarService.DesEncriptar(usuario['token']);
      this.crud.ActualizarVistasEmpleado(token, id_empleado, n_vistas).subscribe(
        data => {
          if(data['error']) {
            this._isError = true;
            this._mensajeError = data['mensaje'];
          }
          else {
            //console.log(data);
            this._isError = false;
            this._mensajeError = '';
          }
        },
        error => console.log(error),
      );
    }

  //#endregion
}
