import { Component } from '@angular/core';
import { Factura } from '../../modules/factura';
import { FacturaService } from '../../services/factura.service';
import { RouterLink } from '@angular/router';
import { CommonModule } from '@angular/common';

@Component({
  selector: 'app-principal',
  imports: [RouterLink, CommonModule],
  templateUrl: './principal.component.html',
  styleUrl: './principal.component.css'
})
export class PrincipalComponent {
  public listaFacturas: Factura[] = [];

  //Constructor que inicializa la petición de listado de facturas par amostrar en pantalla la tabla de las mismas
  constructor(private peticion: FacturaService) {
    this.peticion.listarFacturas().subscribe(datos => {
      console.log("Estamos en constructor de principal.component.ts :>> ", datos);
      this.listaFacturas = datos;
    });
  }
}
