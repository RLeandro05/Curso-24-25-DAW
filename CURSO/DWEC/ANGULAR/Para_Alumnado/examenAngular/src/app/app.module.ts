import { NgModule } from '@angular/core';
import { BrowserModule } from '@angular/platform-browser';

import { AppRoutingModule } from './app-routing.module';
import { AppComponent } from './app.component';
import { PrincipalComponent } from './components/principal/principal.component';
import { HttpClientModule } from '@angular/common/http';
import { ListaDetalleComponent } from './components/lista-detalle/lista-detalle.component';

@NgModule({
  declarations: [
    AppComponent,
    PrincipalComponent,
    ListaDetalleComponent
  ],
  imports: [
    BrowserModule,
    AppRoutingModule,
    HttpClientModule
  ],
  providers: [],
  bootstrap: [AppComponent]
})
export class AppModule { }
