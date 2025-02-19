import { Component, Input } from '@angular/core';
import { PeliculasService } from '../../services/peliculas.service';
import { FormBuilder, FormGroup, Validators } from '@angular/forms';
import { Genero } from '../../models/genero';
import { ReactiveFormsModule } from '@angular/forms';

@Component({
  selector: 'app-pelicula-form',
  imports: [ReactiveFormsModule],
  templateUrl: './pelicula-form.component.html',
  styleUrl: './pelicula-form.component.css'
})
export class PeliculaFormComponent {
  @Input() idTraido: number = 0;
  public form: FormGroup;

  constructor(private servicePeliculas: PeliculasService, private fb: FormBuilder) {
    this.form = fb.group({
          id: fb.control("-1"),
          nombre: fb.control('', [Validators.required]),
          fecha: fb.control(null, [Validators.required]),
          genero: fb.control({} as Genero, [Validators.required]),
          sinopsis: fb.control("", [Validators.required]),
        });
  }

  onSubmit() {
    
  }
}
