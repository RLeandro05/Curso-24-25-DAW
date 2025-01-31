import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { DetallesFactura } from '../modules/detalles-factura';

@Injectable({
  providedIn: 'root'
})
export class ListaDetalleService {
  //urlUsada: "http://localhost/Curso-24-25-DAW/CURSO/DWEC/ANGULAR/Para_Alumnado/servidor.php"
  private url: string = "http://localhost/Curso-24-25-DAW/CURSO/DWEC/ANGULAR/Para_Alumnado/servidor.php";
  
    constructor(private http:HttpClient) { }
  
    //Método para listar una factura en específico a partir del id pasado
    listarDetallesFactura(idFactura: number) {
      let cuerpo = {
        id: idFactura,
        servicio: "detalle"
      };
      return this.http.post<DetallesFactura[]>(this.url, cuerpo);
    }

    //Método para insertar un nuevo detalle de factura
    nuevoDetalle(detalleFactura: DetallesFactura) {
      let cuerpo = {
        servicio: "anade",
        detalle: detalleFactura
      }
      return this.http.post<DetallesFactura[]>(this.url, cuerpo);
    }

    //Método para borrar un detalle específico
    borrarDetalle(idDetalle: number, id_facturaDetalle: number) {
      let cuerpo = {
        servicio: "borra",
        id: idDetalle,
        id_factura: id_facturaDetalle
      }
      return this.http.post<DetallesFactura[]>(this.url, cuerpo);
    }

    //Método para editar un detalle específico
    editarDetalle(detalleFactura: DetallesFactura) {
      let cuerpo = {
        servicio: "modifica",
        detalle: detalleFactura
      }
      return this.http.post<DetallesFactura[]>(this.url, cuerpo);
    }
}
