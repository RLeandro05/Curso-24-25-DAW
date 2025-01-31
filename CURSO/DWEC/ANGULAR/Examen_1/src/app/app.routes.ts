import { Routes } from '@angular/router';
import { PrincipalComponent } from './components/principal/principal.component';
import { ListaDetalleComponent } from './components/lista-detalle/lista-detalle.component';

export const routes: Routes = [
    {path: "", component: PrincipalComponent},
    {path: "lista-detalle/:id/:numero", component: ListaDetalleComponent}
];
