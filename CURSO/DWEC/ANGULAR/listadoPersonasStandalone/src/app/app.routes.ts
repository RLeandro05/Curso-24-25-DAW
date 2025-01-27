import { Routes } from '@angular/router';
import { ListadoPersonasComponent } from './componentes/listado-personas/listado-personas.component';
import { FormPersonasComponent } from './componentes/form-personas/form-personas.component';

export const routes: Routes = [
    {path:"", component: ListadoPersonasComponent},
    {path:"personas-add/:id", component: FormPersonasComponent}
];
