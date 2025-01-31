import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';
import { PrincipalComponent } from './components/principal/principal.component';
import { ListaDetalleComponent } from './components/lista-detalle/lista-detalle.component';

const routes: Routes = [
  {path: "", component: PrincipalComponent},
  {path: "lista-detalle/:id/:numero", component: ListaDetalleComponent}
];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule { }
