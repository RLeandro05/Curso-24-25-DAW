import { Component } from '@angular/core';
import { Factura } from '../../modules/factura';
import { PAjaxService } from '../../services/pajax.service';
import { RouterLink } from '@angular/router';

@Component({
  selector: 'app-principal',
  imports: [RouterLink],
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
