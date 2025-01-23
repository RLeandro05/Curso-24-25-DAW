import { Component } from '@angular/core';
import { Persona } from '../../modelos/persona';
import { Router, ActivatedRoute } from '@angular/router';
import { PAjaxService } from '../../servicios/p-ajax.service';

@Component({
  selector: 'app-form-persona',
  standalone: false,
  
  templateUrl: './form-persona.component.html',
  styleUrl: './form-persona.component.css'
})
export class FormPersonaComponent {
  //public persona: Persona;
  public persona: Persona = <Persona>{};
  public textoBoton: string;

  constructor(private peticion:PAjaxService) {
    this.persona = {
      ID: -1,
      DNI: "",
      NOMBRE: "",
      APELLIDOS: ""
    }
    this.textoBoton = "Añadir";
  }
}
