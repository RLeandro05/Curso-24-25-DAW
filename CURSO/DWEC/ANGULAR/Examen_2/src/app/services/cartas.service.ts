import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { environment } from '../../environments/environment.development';
import { Carta } from '../models/carta';

@Injectable({
  providedIn: 'root'
})
export class CartasService {
  public url: string = environment.API_URL;

  constructor(private http: HttpClient) { }

  anadeCarta(carta: Carta) {
    let cuerpo = {
      accion: "AnadeLiniaCarta",
      carta: carta
    };
    return this.http.post<any>(this.url, cuerpo);
  }

  borrarLineaCarta(idLineaCarta: number) {
    let cuerpo = {
      accion: "BorrarLiniaCarta",
      id: idLineaCarta
    };
    return this.http.post<any>(this.url, cuerpo);
  }

  obtenerCartaIdLocal(idLocal: number) {
    let cuerpo = {
      accion: "ObtenerCartaIdLocal",
      id: idLocal
    };
    return this.http.post<Carta[]>(this.url, cuerpo);
  }

  obtenerLiniaCartaId(idLineaCarta: number) {
    let cuerpo = {
      accion: "ObtenerLiniaCartaId",
      id: idLineaCarta
    };
    return this.http.post<Carta>(this.url, cuerpo);
  }

  modificaLiniaCarta(carta: Carta) {
    let cuerpo = {
      accion: "ModificaLiniaCarta",
      carta: carta
    };
    return this.http.post<any>(this.url, cuerpo);
  }
}
