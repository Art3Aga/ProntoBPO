import { PuestosModel } from './../modelos/puestosModel';
import { DepartamentoModel } from './../modelos/departamentoModel';
import { ProfesionalModel } from './../modelos/profesionalModel';
import { environment } from './../../environments/environment';
import { Injectable } from '@angular/core';
import { HttpClient, HttpParams, HttpHeaders } from "@angular/common/http";
import { LoginModel } from '../modelos/loginModel';
import { Observable } from 'rxjs';
import { tap, map, catchError, switchMap } from 'rxjs/operators';

@Injectable({
  providedIn: 'root'
})
export class CrudService {

  constructor(private http: HttpClient) { }


  //#region Metodos CRUD

  //#region READ
  public VerificarCuenta(cuenta: LoginModel): Observable<string> {

    const login = new HttpParams()
    .set('login', cuenta.login)
    .set('password', cuenta.password);
    const url = `${environment.url}/Login/VerificarCuentaSocios`;
    const headers = new HttpHeaders()
    .set('Content-Type', 'application/x-www-form-urlencoded; charset-UTF-8;');
    return this.http.post(url, login.toString(), {headers, responseType: 'text'});

  }
  public ObtenerTodosProfesionales(token: string): Observable<ProfesionalModel[]> {
    const url = `${environment.url}/Employee/ObtenerTodosEmpleados/${token}`;
    return this.http.get<ProfesionalModel[]>(url).pipe(
      tap(data => JSON.stringify(data))
    );
  }
  public AgruparProfesionalesPorDepartamento(token: string, department_id: number, nombre_empleado: string): Observable<ProfesionalModel[]> {
    const url = `${environment.url}/Departament/ObtenerEmpleadosPorDepartamentos/${token}/${department_id}/${nombre_empleado}`;
    return this.http.get<ProfesionalModel[]>(url).pipe(
      tap(data => JSON.stringify(data))
    );
  }
  public ObtenerDepartamentos(token: string): Observable<DepartamentoModel[]> {
    const url = `${environment.url}/Departament/ObtenerTodosDepartamentos/${token}`;
    return this.http.get<DepartamentoModel[]>(url).pipe(
      tap(data => JSON.stringify(data))
    );
  }
  public BuscarDepartamentosByID(token: string, department_id: number): Observable<DepartamentoModel[]> {
    const url = `${environment.url}/Departament/BuscarDepartamentos/${token}/${department_id}`;
    return this.http.get<DepartamentoModel[]>(url).pipe(
      tap(data => JSON.stringify(data))
    );
  }
  public BuscarDepartamentosPorEmpleado(token: string, nombre_empleado: string): Observable<DepartamentoModel[]> {
    const url = `${environment.url}/Employee/BuscarEmpleadosDepartamento/${token}/${nombre_empleado}`;
    return this.http.get<DepartamentoModel[]>(url).pipe(
      tap(data => JSON.stringify(data))
    );
  }
  public BuscarPuestosPorEmpleado(token: string, nombre_empleado: string): Observable<PuestosModel[]> {
    const url = `${environment.url}/Employee/BuscarEmpleadosPuesto/${token}/${nombre_empleado}`;
    return this.http.get<PuestosModel[]>(url).pipe(
      tap(data => JSON.stringify(data))
    );
  }
  public ObtenerPuestos(token: string): Observable<PuestosModel[]> {
    const url = `${environment.url}/Jobs/ObtenerTodosPuestos/${token}`;
    return this.http.get<PuestosModel[]>(url).pipe(
      tap(data => JSON.stringify(data))
    );
  }
  public BuscarPuestosByID(token: string, job_id: number): Observable<PuestosModel[]> {
    const url = `${environment.url}/Jobs/BuscarPuestos/${token}/${job_id}`;
    return this.http.get<PuestosModel[]>(url).pipe(
      tap(data => JSON.stringify(data))
    );
  }
  public AgruparProfesionalesPorPuesto(token: string, job_id: number, nombre_empleado: string): Observable<ProfesionalModel[]> {
    const url = `${environment.url}/Jobs/ObtenerEmpleadosPorPuesto/${token}/${job_id}/${nombre_empleado}`;
    return this.http.get<ProfesionalModel[]>(url).pipe(
      tap(data => JSON.stringify(data))
    );
  }
  public BuscarEmpleadosTodos(token: string, name_empleado: string): Observable<ProfesionalModel[]> {
    const url = `${environment.url}/Employee/BuscarEmpleadosTodos/${token}/${name_empleado}`;
    return this.http.get<ProfesionalModel[]>(url).pipe(
      tap(data => JSON.stringify(data))
    );
  }
  public ExisteVistadeEmpleado(token: string, id_empleado: number): Observable<string> {
    const url = `${environment.url}/Employee/ExisteVistadeEmpleado/${token}/${id_empleado}`;
    return this.http.get<string>(url).pipe(
      tap(data => JSON.stringify(data))
    );
  }
  public ObtenerVistasPorPuesto(token: string, job_id: number): Observable<string> {
    const url = `${environment.url}/Jobs/VistasPorPuesto/${token}/${job_id}`;
    return this.http.get<string>(url).pipe(
      tap(data => JSON.stringify(data))
    );
  }
  public TodasVistasPuesto(token: string): Observable<PuestosModel[]> {
    const url = `${environment.url}/Jobs/TodasVistasPuesto/${token}`;
    return this.http.get<PuestosModel[]>(url).pipe(
      tap(data => JSON.stringify(data))
    );
  }
  //#endregion



  //#region UPDATE

  public ActualizarVistasPorPuesto(token: string, job_id: number, n_vistas: number): Observable<string> {
    const url = `${environment.url}/Jobs/ActualizarVistasPorPuesto/${token}/${job_id}/${n_vistas}`;
    return this.http.get<string>(url).pipe(
      tap(data => JSON.stringify(data))
    );
  }

  public ActualizarVistasEmpleado(token: string, id_empleado: number, n_vistas: number): Observable<string> {
    const url = `${environment.url}/Employee/ActualizarVistasEmpleado/${token}/${id_empleado}/${n_vistas}`;
    return this.http.get<string>(url).pipe(
      tap(data => JSON.stringify(data))
    );
  }

  //#endregion



  //#region CREATE
  public CrearSocioYAdmin(): Observable<string> {
    const url = `${environment.url}/Login/ExisteUsuario`;
    return this.http.get<string>(url).pipe(
      tap(data => JSON.stringify(data))
    );
  }
  //#endregion




  //#endregion



}
