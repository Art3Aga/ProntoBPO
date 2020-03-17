import { Observable } from 'rxjs';
import { EncriptarService } from './../servicios/encriptar.service';
//import { AccionesService } from './../servicios/acciones.service';
import { PuestosModel } from './../modelos/puestosModel';
import { CrudService } from './../servicios/crud.service';
import { Injectable } from '@angular/core';

@Injectable({
  providedIn: 'root'
})
export class PuestoController {

  //#region Atributos

  private _ListaPuestos : PuestosModel[] = [];
  public get getListaPuestos() : PuestosModel[] {
    return this._ListaPuestos;
  }
  public set setListaPuestos(nuevaLista : PuestosModel[]) {
    this._ListaPuestos = nuevaLista;
  }

  private _ListaPuestos2 : PuestosModel[] = [];
  public get getListaPuestos2() : PuestosModel[] {
    return this._ListaPuestos2;
  }
  public set setListaPuestos2(nuevaLista : PuestosModel[]) {
    this._ListaPuestos2 = nuevaLista;
  }

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

  //#endregion

  constructor(private crud: CrudService, private encriptarService: EncriptarService,
    /*private accionesService: AccionesService*/) { }




  //#region Metodos

  public ObtenerPuestos() {
    let usuario: any = JSON.parse(localStorage.getItem('socio'));
    let token: any = this.encriptarService.DesEncriptar(usuario['token']);
    this._cargando = true;
    this.crud.ObtenerPuestos(token).subscribe(
      data => {
        this._cargando = false;
        if(data['error']) {
          //this.accionesService.ShowMensaje(data['mensaje'], '', 9000, 'bad', 'bottom');
          this._isError = true;
          this._mensajeError = data['mensaje'];
        }
        else {
          this._ListaPuestos = data;
          this._ListaPuestos2 = data;
          this._isError = false;
          this._mensajeError = '';
        }
      },
      error => console.log(error),
    );
  }

  public BuscarPuestosByID(job_id: number) {
    let usuario: any = JSON.parse(localStorage.getItem('socio'));
    let token: any = this.encriptarService.DesEncriptar(usuario['token']);
    this._cargando = true;
    this.crud.BuscarPuestosByID(token, job_id).subscribe(
      data => {
        this._cargando = false;
        if(data['error']) {
          //this.accionesService.ShowMensaje(data['mensaje'], '', 9000, 'bad', 'bottom');
          this._isError = true;
          this._mensajeError = data['mensaje'];
        }
        else {
          this._ListaPuestos = data;
          this._isError = false;
          this._mensajeError = '';
        }
      },
      error => console.log(error),
    );
  }


  public BuscarPuestosByEmpleado(nombre_empleado: string) {
    let usuario: any = JSON.parse(localStorage.getItem('socio'));
    let token: any = this.encriptarService.DesEncriptar(usuario['token']);
    this._cargando = true;
    this.crud.BuscarPuestosPorEmpleado(token, nombre_empleado).subscribe(
      data => {
        this._cargando = false;
        if(data['error']) {
          //this.accionesService.ShowMensaje(data['mensaje'], '', 9000, 'bad', 'bottom');
          this._isError = true;
          this._mensajeError = data['mensaje'];
        }
        else {
          this._ListaPuestos = data;
          this._isError = false;
          this._mensajeError = '';
        }
      },
      error => console.log(error),
    );
  }
  public VistasPorPuesto(job_id: number): Observable<string> {
    let usuario: any = JSON.parse(localStorage.getItem('socio'));
    let token:any = this.encriptarService.DesEncriptar(usuario['token']);
    return this.crud.ObtenerVistasPorPuesto(token, job_id);
  }

  public TodasVistasPuesto(): Observable<PuestosModel[]> {
    let usuario: any = JSON.parse(localStorage.getItem('socio'));
    let token:any = this.encriptarService.DesEncriptar(usuario['token']);
    return this.crud.TodasVistasPuesto(token);
  }


  public UpdateVistasPorPuesto(job_id: number, n_vistas: number) {
    let usuario: any = JSON.parse(localStorage.getItem('socio'));
    let token:any = this.encriptarService.DesEncriptar(usuario['token']);
    this.crud.ActualizarVistasPorPuesto(token, job_id, n_vistas).subscribe(
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
