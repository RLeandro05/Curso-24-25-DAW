import { Component } from '@angular/core';
import { PAjaxService } from '../../services/pajax.service';
import { Factura } from '../../modules/factura';

@Component({
  selector: 'app-principal',
  standalone: false,
  
  templateUrl: './principal.component.html',
  styleUrl: './principal.component.css'
})
export class PrincipalComponent {
  public listaFacturas: Factura[] = [];

  //Constructor que inicializa la petición de listado de facturas par amostrar en pantalla la tabla de las mismas
  constructor(private peticion: PAjaxService) {
    this.peticion.listarFacturas().subscribe(datos => {
      console.log("Estamos en constructor de principal.component.ts :>> ", datos);
      this.listaFacturas = datos;
    });
  }
}
