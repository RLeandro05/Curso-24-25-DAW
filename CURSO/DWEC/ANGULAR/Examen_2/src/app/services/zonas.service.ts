import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { environment } from '../../environments/environment.development';
import { Zona } from '../models/zona';

@Injectable({
  providedIn: 'root'
})
export class ZonasService {
  public url: string = environment.API_URL;

  constructor(private http: HttpClient) { }

  listarZonas() {
    let cuerpo = {
      accion: "ListarZonas"
    };
    return this.http.post<Zona[]>(this.url, cuerpo);
  }

  borraZona(idZona: number) {
    let cuerpo = {
      accion: "BorrarZona",
      id: idZona
    };
    return this.http.post<Zona[]>(this.url, cuerpo);
  }

  anadirZona(zona: Zona) {
    let cuerpo = {
      accion: "AnadeZona",
      zona: zona
    };
    return this.http.post<any>(this.url, cuerpo);
  }

  modificaZona(zona: Zona) {
    let cuerpo = {
      accion: "ModificaZona",
      zona: zona
    };
    return this.http.post<any>(this.url, cuerpo);
  }
}
