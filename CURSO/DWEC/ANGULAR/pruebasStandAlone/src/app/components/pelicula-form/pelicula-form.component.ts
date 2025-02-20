import { Component, EventEmitter, Input, Output } from '@angular/core';
import { PeliculasService } from '../../services/peliculas.service';
import { FormBuilder, FormGroup, Validators } from '@angular/forms';
import { Genero } from '../../models/genero';
import { ReactiveFormsModule } from '@angular/forms';
import { Interprete } from '../../models/interprete';
import { InterpretesService } from '../../services/interpretes.service';
import { Pelicula } from '../../models/pelicula';

@Component({
  selector: 'app-pelicula-form',
  imports: [ReactiveFormsModule],
  templateUrl: './pelicula-form.component.html',
  styleUrl: './pelicula-form.component.css'
})
export class PeliculaFormComponent {
  @Input() peliculaTraida: Pelicula = <Pelicula>{};
  @Output() peliculaNueva = new EventEmitter<Pelicula>();

  public form: FormGroup = <FormGroup>{};
  public listGeneros: Genero[] = [];
  public listInterpretes: Interprete[] = [];

  constructor(private servicePeliculas: PeliculasService, private serviceInterpretes: InterpretesService, private fb: FormBuilder) {
  }

  ngOnInit() {
    console.log("idTraido :>> ", this.peliculaTraida.id);

    this.form = this.fb.group({
      id: this.fb.control("-1"),
      nombre: this.fb.control("", [Validators.required]),
      fecha: this.fb.control("", [Validators.required]),
      genero: this.fb.control("", [Validators.required]),
      sinopsis: this.fb.control("", [Validators.required]),
      interpretes: this.fb.control(null)
    });
    
    this.servicePeliculas.listarGeneros().subscribe(
      datos => {
        this.listGeneros = datos;
        console.log("listGeneros :>> ", this.listGeneros);
        
      }, error => console.log("Error al obtener los géneros :>> ", error)
    )

    this.serviceInterpretes.listarInterpretes().subscribe(
      datos => {
        this.listInterpretes = datos;
        console.log("listInterpretes :>> ", this.listInterpretes);

        if(this.peliculaTraida.id != -1) {
          this.configurarFormulario();
        }
        
      }, error => console.log("Error al obtener los intérpretes :>> ", error)
    )
  }

  configurarFormulario() {
    const generoEncontrado = this.listGeneros.find(
      (g) => g.id === this.peliculaTraida.genero.id
    );

    this.form = this.fb.group({
      id: this.fb.control(this.peliculaTraida.id),
      nombre: this.fb.control(this.peliculaTraida.nombre, [Validators.required]),
      fecha: this.fb.control(this.peliculaTraida.fecha, [Validators.required]),
      genero: this.fb.control(generoEncontrado, [Validators.required]),
      sinopsis: this.fb.control(this.peliculaTraida.sinopsis, [Validators.required]),
      interpretes: this.fb.control(this.peliculaTraida.interpretes)
    });
  }

  onSubmit() {
    
    if(this.peliculaTraida.id === -1) {

      console.log("peliculaNueva :>> ", this.form.value);
      
      this.peliculaNueva.emit(this.form.value);
    }
  }
}
