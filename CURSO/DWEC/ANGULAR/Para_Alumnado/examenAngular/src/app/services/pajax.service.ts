import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Factura } from '../modules/factura';
import { DetallesFactura } from '../modules/detalles-factura';

@Injectable({
  providedIn: 'root'
})
export class PAjaxService {

  private url: string = "http://localhost/Curso-24-25-DAW/DWEC/ANGULAR/Para_Alumnado/servidor.php";

  constructor(private http:HttpClient) {}

  //Método para listar facturas
  listarFacturas() {
    let cuerpo = {
      servicio: "facturas"
    };
    return this.http.post<Factura[]>(this.url, cuerpo);
  }

  //Método para listar una factura en específico a partir del id pasado
  listarDetallesFactura(idFactura: number) {
    let cuerpo = {
      id: idFactura,
      servicio: "detalle"
    };
    return this.http.post<DetallesFactura[]>(this.url, cuerpo);
  }
}
