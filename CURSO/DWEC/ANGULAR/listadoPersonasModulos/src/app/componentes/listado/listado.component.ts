import { Component } from '@angular/core';
import { PAjaxService } from '../../servicios/p-ajax.service';
import { Persona } from '../../modelos/persona';
import { Router } from '@angular/router';

@Component({
  selector: 'app-listado',
  standalone: false,
  
  templateUrl: './listado.component.html',
  styleUrl: './listado.component.css'
})
export class ListadoComponent {
  public listaPer: Persona[] = [];

  constructor(private peticion: PAjaxService, private ruta: Router) {
    this.peticion.listarPersonas().subscribe(datos => {
      console.log("Estamos en el constructor", datos);
      this.listaPer = datos;
    })
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
