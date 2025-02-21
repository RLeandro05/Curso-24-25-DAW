import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { environment } from '../../environments/environment.development';
import { Local } from '../models/local';

@Injectable({
  providedIn: 'root'
})
export class LocalesService {
  public url: string = environment.API_URL;

  constructor(private http:HttpClient) { }

  listarLocales() {
    let cuerpo = {
      accion: "ListarLocales"
    };
    return this.http.post<Local[]>(this.url, cuerpo);
  }

  anadeLocal(local: Local) {
    let cuerpo = {
      accion: "AnadeLocal",
      local: local
    };
    return this.http.post<any>(this.url, cuerpo);
  }

  obtenerLocalId(idLocal: number) {
    let cuerpo = {
      accion: "ObtenerLocalId",
      id: idLocal
    };
    return this.http.post<Local>(this.url, cuerpo);
  }

  borrarLocal(idLocal: number) {
    let cuerpo = {
      accion: "BorrarLocal",
      id: idLocal
    };
    return this.http.post<any>(this.url, cuerpo);
  }

  modificaLocal(local: Local) {
    let cuerpo = {
      accion: "ModificaLocal",
      local: local
    };
    return this.http.post<any>(this.url, cuerpo);
  }
}
