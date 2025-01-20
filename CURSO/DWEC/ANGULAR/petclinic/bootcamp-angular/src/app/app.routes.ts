import { Routes } from '@angular/router';
import { HomeComponent } from './home/home.component';
import { BorrarComponent } from './borrar/borrar.component';
import { OtroComponent } from './otro/otro.component';
import { OwnersComponent } from './owners/owners.component';

export const routes: Routes = [
    {path: '', component: HomeComponent},
    {path: 'borrar', component: BorrarComponent},
    {path: 'otro', component: OtroComponent},
    {path: 'otro', component: OwnersComponent},
];
