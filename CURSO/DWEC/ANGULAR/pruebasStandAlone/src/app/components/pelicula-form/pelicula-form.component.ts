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
  @Input() idTraido: number = 0;
  @Output() peliculaNueva = new EventEmitter<Pelicula>();

  public form: FormGroup;
  public listGeneros: Genero[] = [];
  public listInterpretes: Interprete[] = [];

  constructor(private servicePeliculas: PeliculasService, private serviceInterpretes: InterpretesService, private fb: FormBuilder) {
    this.form = fb.group({
      id: fb.control("-1"),
      nombre: fb.control("", [Validators.required]),
      fecha: fb.control("", [Validators.required]),
      genero: fb.control("", [Validators.required]),
      sinopsis: fb.control("", [Validators.required]),
      interpretes: fb.control(null)
    });
    
  }

  ngOnInit() {
    console.log("idTraido :>> ", this.idTraido);
    
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
        
      }, error => console.log("Error al obtener los intérpretes :>> ", error)
    )
  }

  onSubmit() {
    
    if(this.idTraido === -1) {

      console.log("peliculaNueva :>> ", this.form.value);
      
      this.peliculaNueva.emit(this.form.value);
    }
  }
}
