import { EncriptarService } from './servicios/encriptar.service';
import { LoginController } from './controladores/login-controller.service';
import { AccionesService } from './servicios/acciones.service';
import { Component } from '@angular/core';
import { FormControl, Validators } from '@angular/forms';

@Component({
  selector: 'app-root',
  templateUrl: './app.component.html',
  styleUrls: ['./app.component.scss']
})
export class AppComponent {

  constructor(private acciones: AccionesService, public loginController: LoginController,
    private encriptarService: EncriptarService) {}

  //#region Atributos
  hide: boolean;
  siguientePagina: boolean;
  email = new FormControl('', [Validators.required])
  clave = new FormControl('', [Validators.required])
  cargando: boolean = false;
  //#endregion

  IsLogueado(): boolean {
    return localStorage.getItem('socio') ? true : false
  }

  Login() {
    if(this.email.valid && this.clave.valid) {
      this.loginController.setCuenta = {
        login: this.email.value,
        password: this.clave.value,
      };
      this.cargando = true;
      this.loginController.VerificarCuenta().subscribe(
        data => {
          this.cargando = false;
          let respuesta: any = JSON.parse(data);
          if(respuesta['error']) {
            this.acciones.ShowMensaje(respuesta['mensaje'], '', 3000, 'bad', 'bottom')
          }
          else {
            this.acciones.ShowMensaje('Bienvenido a ProntoBPO', '', 3000, 'nice', 'bottom')
            this.siguientePagina = !this.siguientePagina;
            let socio: any = {
              usuario: this.encriptarService.Encriptar(respuesta['login']),
              id: this.encriptarService.Encriptar(respuesta['id']),
              token: this.encriptarService.Encriptar(respuesta['signature']),
              tipoUsuario: this.encriptarService.Encriptar(respuesta['alias_id'])
            };
            localStorage.setItem('socio', JSON.stringify(socio));
          }
        },
        error => console.log(error)
      );
    }
    else {
      this.acciones.ShowMensaje('Faltan Datos', '', 3000, 'bad', 'bottom')
    }
  }

}

