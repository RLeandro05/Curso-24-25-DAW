import { Routes } from '@angular/router';
import { LocalesListComponent } from './components/locales/locales-list/locales-list.component';
import { LocalesFormComponent } from './components/locales/locales-form/locales-form.component';
import { LocalDetalleComponent } from './components/locales/local-detalle/local-detalle.component';
import { CartasFormComponent } from './components/cartas/cartas-form/cartas-form.component';
import { ZonasListComponent } from './components/zonas/zonas-list/zonas-list.component';

export const routes: Routes = [
    {path: "", component: LocalesListComponent},
    {path: "locales-form/:idLocal", component: LocalesFormComponent},
    {path: "locales-detail/:idLocal", component: LocalDetalleComponent},
    {path: "cartas-form/:idLocal/:idLineaCarta", component: CartasFormComponent},
    {path: "zonas/:idLocal", component: ZonasListComponent}
];
