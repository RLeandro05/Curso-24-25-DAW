import { Component } from '@angular/core';
import { Pelicula } from '../../models/pelicula';
import { PeliculasService } from '../../services/peliculas.service';
import { DatePipe } from '@angular/common';
import { RouterLink } from '@angular/router';
import { PeliculaFormComponent } from "../pelicula-form/pelicula-form.component";

@Component({
  selector: 'app-peliculas',
  imports: [DatePipe, RouterLink, PeliculaFormComponent],
  templateUrl: './peliculas.component.html',
  styleUrl: './peliculas.component.css'
})
export class PeliculasComponent {
  public listPeliculas: Pelicula[] = [];
  public mostrarForm: boolean = false;
  public textButton: string = "Añadir";
  
    constructor(private servicePeliculas: PeliculasService) {}
  
    ngOnInit() {
      console.log("Entra en ngOnInit");
      
      this.servicePeliculas.listarPeliculas().subscribe(
        datos => {
          this.listPeliculas = datos;
          console.log("listPeliculas :>> ", this.listPeliculas);
          
        }, error => console.log("Error al obtener listPeliculas :>> ", error)
      )
    }

    borrarPelicula(peliculaBorrar: Pelicula) {
        console.log("peliculaBorrar :>> ", peliculaBorrar);
        
        if(confirm("¿Deseas eliminar a '"+peliculaBorrar.nombre+"'?")) {
          this.servicePeliculas.borrarPelicula(peliculaBorrar.id).subscribe(
            datos => {
              this.listPeliculas = datos;
              console.log("listPeliculas después de borrar :>> ", datos);
            }, error => console.log("Error al borrar la película :>> ", error)
          )
        }
    }

    mostrarFormulario() {

      this.mostrarForm = !this.mostrarForm;

      console.log(this.mostrarForm);
      

      if(this.mostrarForm == true) {
        this.textButton = "Cerrar";
      } else {
        this.textButton = "Añadir"
      }
    }

    agregarPelicula(nuevaPelicula: Pelicula) {
      this.listPeliculas.push(nuevaPelicula);
      this.mostrarForm = false;
    }
}
