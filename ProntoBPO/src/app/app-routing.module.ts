import { NuevoSocioComponent } from './vistas/nuevo-socio/nuevo-socio.component';
import { SociosComponent } from './vistas/socios/socios.component';
import { PuestosComponent } from './vistas/puestos/puestos.component';
import { PerfilProfesionalComponent } from './vistas/perfil-profesional/perfil-profesional.component';
import { ProfesionalesComponent } from './vistas/profesionales/profesionales.component';
import { AppComponent } from './app.component';
import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';


const routes: Routes = [
  { path: 'profesionales', component: ProfesionalesComponent },
  { path: 'perfil-profesional', component: PerfilProfesionalComponent },
  { path: 'puestos', component: PuestosComponent },
  { path: 'login', component: AppComponent },
  { path: 'socios', component: SociosComponent },
  { path: 'nuevo-socio', component: NuevoSocioComponent },
  { path: '**', redirectTo: 'login' }
];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule { }
