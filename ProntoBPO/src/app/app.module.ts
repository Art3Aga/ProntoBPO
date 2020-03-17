import { AccionesService } from './servicios/acciones.service';
import { BrowserModule } from '@angular/platform-browser';
import { NgModule } from '@angular/core';

import { AppRoutingModule } from './app-routing.module';
import { AppComponent } from './app.component';
import { BrowserAnimationsModule } from '@angular/platform-browser/animations';
// Angular Material
import { MatInputModule, MatButtonModule, MatSelectModule, MatIconModule, MatToolbarModule,
  MatSidenavModule, MatListModule, MatTabsModule, MatGridListModule, MatExpansionModule,
  MatCardModule, MatSlideToggleModule, MatChipsModule, MatSliderModule, MatTableModule, MatBadgeModule,
  MatSnackBarModule, MatFormFieldModule, MatDialogModule, MatTooltipModule,
  MatButtonToggleModule, MatDatepickerModule, MatNativeDateModule, MatPaginatorModule,
  MatBottomSheetModule, MatProgressSpinnerModule,
  MAT_DIALOG_DATA,
  MatDialogRef} from '@angular/material';
// HTTP
import { HttpClientModule } from '@angular/common/http';
// Formularios
import { FormsModule, ReactiveFormsModule } from '@angular/forms';
import { SidebarComponent } from './vistas/sidebar/sidebar.component';
import { ProfesionalesComponent } from './vistas/profesionales/profesionales.component';
import { ItemProfesionalComponent } from './componentes/item-profesional/item-profesional/item-profesional.component';
import { PerfilProfesionalComponent } from './vistas/perfil-profesional/perfil-profesional.component';
import { PuestosComponent } from './vistas/puestos/puestos.component';
import { DepartProfesionalListComponent } from './componentes/depart-profesional-list/depart-profesional-list.component';
import { PuestoProfesionalListComponent } from './componentes/puesto-profesional-list/puesto-profesional-list.component';
import { SociosComponent } from './vistas/socios/socios.component';
import { NuevoSocioComponent } from './vistas/nuevo-socio/nuevo-socio.component';

@NgModule({
  declarations: [
    AppComponent,
    SidebarComponent,
    ProfesionalesComponent,
    ItemProfesionalComponent,
    PerfilProfesionalComponent,
    PuestosComponent,
    DepartProfesionalListComponent,
    PuestoProfesionalListComponent,
    SociosComponent,
    NuevoSocioComponent
  ],
  imports: [
    BrowserModule,
    AppRoutingModule,
    BrowserAnimationsModule,
    FormsModule, ReactiveFormsModule,
    MatInputModule, MatButtonModule, MatSelectModule, MatIconModule, MatToolbarModule,
    MatSidenavModule, MatListModule, MatTabsModule, MatGridListModule, MatExpansionModule,
    MatCardModule, MatSlideToggleModule, MatChipsModule, MatSliderModule, MatTableModule,
    MatBadgeModule, MatSnackBarModule, MatFormFieldModule, MatDialogModule, MatTooltipModule,
    MatButtonToggleModule, MatDatepickerModule, MatNativeDateModule, MatPaginatorModule,
    MatBottomSheetModule, MatProgressSpinnerModule,
    HttpClientModule
  ],
  providers: [ AccionesService, { provide: MAT_DIALOG_DATA, useValue: {} }, { provide: MatDialogRef, useValue: {} } ],
  bootstrap: [AppComponent]
})
export class AppModule { }
