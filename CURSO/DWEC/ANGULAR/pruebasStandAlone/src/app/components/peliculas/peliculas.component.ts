import { Component } from '@angular/core';
import { Pelicula } from '../../models/pelicula';
import { PeliculasService } from '../../services/peliculas.service';
import { DatePipe } from '@angular/common';
import { RouterLink } from '@angular/router';
import { PeliculaFormComponent } from "../pelicula-form/pelicula-form.component";
import { Genero } from '../../models/genero';

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
  public pelicula: Pelicula = <Pelicula>{};

  constructor(private servicePeliculas: PeliculasService) {
    this.pelicula = {
      id: -1,
      nombre: "",
      fecha: null,
      genero: {} as Genero,
      sinopsis: "",
      interpretes: []
    }
  }

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

    if (confirm("¿Deseas eliminar a '" + peliculaBorrar.nombre + "'?")) {
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


    if (this.mostrarForm == true) {
      this.textButton = "Cerrar";
    } else {
      this.textButton = "Añadir"
    }
  }

  agregarPelicula(nuevaPelicula: Pelicula) {
    this.servicePeliculas.anadePelicula(nuevaPelicula).subscribe({
      next: () => {
        setTimeout(() => {
          this.servicePeliculas.listarPeliculas().subscribe(
            datos => {
              this.listPeliculas = datos;
            }, error => console.log("Error al actualizar listPeliculas :>> ", error)
          )
        }, 100);
      },
      error: (err) => console.log("Error al añadir nuevaPelicula :>> ", err)
    });

    this.mostrarFormulario();
  }

  editarPelicula(peliculaEditada: Pelicula) {
    this.servicePeliculas.modificaPelicula(peliculaEditada).subscribe({
      next: () => {
        setTimeout(() => {
          this.servicePeliculas.listarPeliculas().subscribe(
            datos => {
              this.listPeliculas = datos;
            }, error => console.error("Error al actualizar listPeliculas :>> ", error)
          )
        }, 100)
      }, error: (err) => console.error("Error al editar peliculaEditada :>> ", err)
    })

    this.mostrarFormulario();
  }

  irAEditar(peliculaEditar: Pelicula) {
    this.pelicula = peliculaEditar;

    console.log("peliculaEditar :>> ", this.pelicula);
    
    this.mostrarFormulario();
  }
}
