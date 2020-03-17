import { PerfilProfesionalComponent } from './../vistas/perfil-profesional/perfil-profesional.component';
import { Injectable } from '@angular/core';
import { MatDialog, MatSnackBar } from '@angular/material';
import { ProfesionalModel } from '../modelos/profesionalModel';

@Injectable({
  providedIn: 'root'
})
export class AccionesService {

  constructor(private snackbar: MatSnackBar, private dialog: MatDialog) { }



  //#region Metodos
  public ShowMensaje(message: string, button: string, duration: number, panelClass: any, position: any) {
    this.snackbar.open(message, button, {
      duration,
      panelClass: [`${panelClass}`],
      verticalPosition: position
    });
  }
  //#endregion


  public OpenModalPerfilProfesional(profesional: ProfesionalModel) {
    this.dialog.open(PerfilProfesionalComponent, {
      width: '80%',
      minWidth: '80%',
      maxWidth: '80%',
      height: '97.9%',
      maxHeight: '97.9%',
      minHeight: '97.9%',
      data: profesional
    });
  }
}
