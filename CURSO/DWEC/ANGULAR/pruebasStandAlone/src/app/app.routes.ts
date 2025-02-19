import { Routes } from '@angular/router';
import { HomeComponent } from './components/home/home.component';
import { InterpretesComponent } from './components/interpretes/interpretes.component';
import { PeliculasComponent } from './components/peliculas/peliculas.component';
import { InterpreteFormComponent } from './components/interprete-form/interprete-form.component';
import { PeliculaFormComponent } from './components/pelicula-form/pelicula-form.component';

export const routes: Routes = [
    {path: "", component: HomeComponent},
    {path: "interpretes", component: InterpretesComponent},
    {path: "peliculas", component: PeliculasComponent},
    {path: "interprete-form/:idInterprete", component: InterpreteFormComponent},
    {path: "pelicula-form/:idPelicula", component: PeliculaFormComponent}
];
