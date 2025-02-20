import { Component } from '@angular/core';
import { Router, RouterLink } from '@angular/router';
import { PAjaxService } from '../../servicios/p-ajax.service';
import { Persona } from '../../modelos/persona';
import { CurrencyPipe } from '@angular/common';

@Component({
  selector: 'app-listado-personas',
  imports: [RouterLink, CurrencyPipe],
  templateUrl: './listado-personas.component.html',
  styleUrl: './listado-personas.component.css'
})
export class ListadoPersonasComponent {
  public listaPer: Persona[] = [];
  public sueldo: number;

  constructor(private peticion: PAjaxService, private ruta: Router) {
    this.peticion.listarPersonas().subscribe(datos => {
      console.log("Estamos en el constructor", datos);
      this.listaPer = datos;
    })

    this.sueldo = 1000;
  }

  borrarPersona(persona: Persona) {
    if (confirm("¿Estás seguro de que deseas eliminar a "+persona.nombre+" "+persona.apellidos+"?")) {
      this.peticion.borrarPersona(persona.id).subscribe(datos => {
        console.log("Estamos en borrarPersona", datos);
        this.listaPer = datos;
      })
    }
  }

  iraNuevaPersona() {
    //console.log("Hola");
    //this.ruta.navigate(["personas-add/-1"]);
    this.ruta.navigate(["personas-add", -1]);
  }
}
