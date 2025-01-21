import { Component } from '@angular/core';
import { PAjaxService } from '../../servicios/p-ajax.service';
import { Persona } from '../../modelos/persona';

@Component({
  selector: 'app-listado',
  standalone: false,
  
  templateUrl: './listado.component.html',
  styleUrl: './listado.component.css'
})
export class ListadoComponent {
  public listaPer: Persona[] = [];

  constructor(private peticion: PAjaxService) {
    this.peticion.listarPersonas().subscribe(datos => {
      console.log("Estamos en el constructor", datos);
      this.listaPer = datos;
    })
  }
}
