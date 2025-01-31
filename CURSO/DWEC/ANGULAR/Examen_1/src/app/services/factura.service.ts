import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { Factura } from '../modules/factura';

@Injectable({
  providedIn: 'root'
})
export class FacturaService {
  //urlUsada: "http://localhost/Curso-24-25-DAW/CURSO/DWEC/ANGULAR/Para_Alumnado/servidor.php"
  private url: string = "http://localhost/Curso-24-25-DAW/CURSO/DWEC/ANGULAR/Para_Alumnado/servidor.php";
  
  constructor(private http:HttpClient) { }

  //Método para listar facturas
  listarFacturas() {
    let cuerpo = {
      servicio: "facturas"
    };
    return this.http.post<Factura[]>(this.url, cuerpo);
  }
}
