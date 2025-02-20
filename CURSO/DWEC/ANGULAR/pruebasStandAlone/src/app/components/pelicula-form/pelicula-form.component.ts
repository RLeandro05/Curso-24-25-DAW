import { Component, EventEmitter, Input, Output } from '@angular/core';
import { CommonModule } from '@angular/common';
import { ReactiveFormsModule, FormBuilder, FormGroup, Validators } from '@angular/forms';
import { PeliculasService } from '../../services/peliculas.service';
import { InterpretesService } from '../../services/interpretes.service';
import { Genero } from '../../models/genero';
import { Interprete } from '../../models/interprete';
import { Pelicula } from '../../models/pelicula';

@Component({
  selector: 'app-pelicula-form',
  standalone: true,
  imports: [CommonModule, ReactiveFormsModule], // ✅ Importación necesaria
  templateUrl: './pelicula-form.component.html',
  styleUrls: ['./pelicula-form.component.css']
})
export class PeliculaFormComponent {
  @Input() idPeliculaTraida: number = 0;
  @Output() peliculaNueva = new EventEmitter<Pelicula>();
  @Output() peliculaEditada = new EventEmitter<Pelicula>();

  public form: FormGroup;

  public listGeneros: Genero[] = [];
  public listInterpretes: Interprete[] = [];
  public pelicula: Pelicula = {} as Pelicula;

  constructor(
    private servicePeliculas: PeliculasService,
    private serviceInterpretes: InterpretesService,
    private fb: FormBuilder
  ) {
    this.form = this.fb.group({
      id: [-1],
      nombre: ["", [Validators.required]],
      fecha: ["", [Validators.required]],
      genero: ["", [Validators.required]],
      sinopsis: ["", [Validators.required]],
      interpretes: [null]
    });
  }

  ngOnInit() {
    console.log("idTraido :>> ", this.idPeliculaTraida);
  
    //Primero carga los géneros
    this.servicePeliculas.listarGeneros().subscribe(
      generos => {
        this.listGeneros = generos;
        console.log("listGeneros :>> ", this.listGeneros);
  
        //Luego carga la película
        if (this.idPeliculaTraida !== -1) {
          this.servicePeliculas.obtenerPeliculaId(this.idPeliculaTraida).subscribe(
            pelicula => {
              this.pelicula = pelicula;
              console.log("peliculaTraida :>> ", this.pelicula);
              this.configurarFormulario(); //Ahora listGeneros ya está cargado
            },
            error => console.log("Error al obtener la película :>> ", error)
          );
        }
      },
      error => console.log("Error al obtener los géneros :>> ", error)
    );
  
    //Cargar intérpretes en paralelo (no depende de géneros)
    this.serviceInterpretes.listarInterpretes().subscribe(
      datos => {
        this.listInterpretes = datos;
        console.log("listInterpretes :>> ", this.listInterpretes);
      },
      error => console.log("Error al obtener los intérpretes :>> ", error)
    );
  }
  

  configurarFormulario() {
    const generoSeleccionado = this.listGeneros.find(genero => genero.id === this.pelicula.genero.id);

    const interpretesSeleccionados = this.listInterpretes.filter(
      interprete => this.pelicula.interpretes.some(i => i.id === interprete.id)
    );

    this.form.patchValue({
      id: this.pelicula.id,
      nombre: this.pelicula.nombre,
      fecha: this.pelicula.fecha,
      genero: generoSeleccionado,
      sinopsis: this.pelicula.sinopsis,
      interpretes: interpretesSeleccionados
    });
  }

  onSubmit() {
    if(this.idPeliculaTraida === -1) {
      console.log("peliculaNueva :>> ", this.form.value);
      this.peliculaNueva.emit(this.form.value);
    } else {
      console.log("peliculaEditada :>> ", this.form.value);
      this.peliculaEditada.emit(this.form.value);
    }
  }
}
