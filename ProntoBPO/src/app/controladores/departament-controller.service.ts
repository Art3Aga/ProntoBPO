import { DepartamentoModel } from './../modelos/departamentoModel';
import { AccionesService } from './../servicios/acciones.service';
import { EncriptarService } from './../servicios/encriptar.service';
import { CrudService } from './../servicios/crud.service';
import { Injectable } from '@angular/core';

@Injectable({
  providedIn: 'root'
})
export class DepartamentController {


  //#region Atributos

  private _ListaDepartamentos : DepartamentoModel[] = [];
  public get getListaDepartamentos() : DepartamentoModel[] {
    return this._ListaDepartamentos;
  }
  public set setListaDepartamentos(nuevaLista : DepartamentoModel[]) {
    this._ListaDepartamentos = nuevaLista;
  }

  private _ListaDepartamentos2: DepartamentoModel[] = [];
  public get getListaDepartamentos2() : DepartamentoModel[] {
    return this._ListaDepartamentos2;
  }
  public set setListaDepartamentos2(nuevaLista : DepartamentoModel[]) {
    this._ListaDepartamentos2 = nuevaLista;
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
    private accionesService: AccionesService) { }


  //#region Metodos

  public ObtenerDepartamentos() {
    let usuario: any = JSON.parse(localStorage.getItem('socio'));
    let token: any = this.encriptarService.DesEncriptar(usuario['token']);
    this._cargando = true;
    this.crud.ObtenerDepartamentos(token).subscribe(
      data => {
        this._cargando = false;
        if(data['error']) {
          this.accionesService.ShowMensaje(data['mensaje'], '', 9000, 'bad', 'bottom');
          this._isError = true;
          this._mensajeError = data['mensaje'];
        }
        else {
          this._ListaDepartamentos = data;
          this._ListaDepartamentos2 = data;
          this._isError = false;
          this._mensajeError = '';
        }
      },
      error => console.log(error),
    );
  }


  public BuscarDepartamentosByID(department_id: number) {
    let usuario: any = JSON.parse(localStorage.getItem('socio'));
    let token: any = this.encriptarService.DesEncriptar(usuario['token']);
    this._cargando = true;
    this.crud.BuscarDepartamentosByID(token, department_id).subscribe(
      data => {
        this._cargando = false;
        if(data['error']) {
          this.accionesService.ShowMensaje(data['mensaje'], '', 9000, 'bad', 'bottom');
          this._isError = true;
          this._mensajeError = data['mensaje'];
        }
        else {
          this._ListaDepartamentos = data;
          this._isError = false;
          this._mensajeError = '';
        }
      },
      error => console.log(error),
    );
  }

  public BuscarDepartamentosByEmpleado(nombre_empleado: string) {
    let usuario: any = JSON.parse(localStorage.getItem('socio'));
    let token: any = this.encriptarService.DesEncriptar(usuario['token']);
    this._cargando = true;
    this.crud.BuscarDepartamentosPorEmpleado(token, nombre_empleado).subscribe(
      data => {
        this._cargando = false;
        if(data['error']) {
          this.accionesService.ShowMensaje(data['mensaje'], '', 9000, 'bad', 'bottom');
          this._isError = true;
          this._mensajeError = data['mensaje'];
        }
        else {
          this._ListaDepartamentos = data;
          this._isError = false;
          this._mensajeError = '';
        }
      },
      error => console.log(error),
    );
  }

  //#endregion
}
