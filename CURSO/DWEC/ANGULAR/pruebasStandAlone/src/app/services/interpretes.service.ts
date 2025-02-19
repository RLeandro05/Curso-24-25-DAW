import { Injectable } from '@angular/core';
import { environment } from '../environments/environment.development';
import { HttpClient } from '@angular/common/http';
import { Interprete } from '../models/interprete';

@Injectable({
  providedIn: 'root'
})
export class InterpretesService {

  private url: string = environment.API_URL;

  constructor(private http:HttpClient) {}

  listarInterpretes() {
    let cuerpo = {
      accion: "ListarInterpretes"
    };
    return this.http.post<Interprete[]>(this.url, cuerpo);
  }

  borrarInterprete(idInterprete: number) {
    let cuerpo = {
      accion: "BorrarInterprete",
      id: idInterprete
    };
    return this.http.post<Interprete[]>(this.url, cuerpo);
  }

  anadeInterprete(interprete: Interprete) {
    let cuerpo = {
      accion: "AnadeInterprete",
      interprete: interprete
    };
    return this.http.post(this.url, cuerpo);
  }

  obtenerInterpreteId(idInterprete: number) {
    let cuerpo = {
      accion: "ObtenerInterpreteId",
      id: idInterprete
    };
    return this.http.post<Interprete>(this.url, cuerpo);
  }

  modificaInterprete(interprete: Interprete) {
    let cuerpo = {
      accion: "ModificaInterprete",
      interprete: interprete
    };
    return this.http.post(this.url, cuerpo);
  }
}
