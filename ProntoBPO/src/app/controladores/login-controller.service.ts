import { Observable } from 'rxjs';
import { LoginModel } from './../modelos/loginModel';
import { CrudService } from './../servicios/crud.service';
import { Injectable } from '@angular/core';

@Injectable({
  providedIn: 'root'
})
export class LoginController {

  //#region Atributos


  private _Cuenta : LoginModel;
  public get getCuenta() : LoginModel {
    return this._Cuenta;
  }
  public set setCuenta(nuevaCuenta : LoginModel) {
    this._Cuenta = nuevaCuenta;
  }


  //#endregion


  constructor(private crud: CrudService) { }


  //#region Metodos

  public VerificarCuenta(): Observable<string> {
    return this.crud.VerificarCuenta(this._Cuenta);
  }

  //#endregion


}
