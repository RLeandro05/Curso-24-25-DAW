import { Injectable } from '@angular/core';
import { environment } from '../../environments/environment.development';
import { HttpClient } from '@angular/common/http';
import { Visit } from '../modules/visit';

@Injectable({
  providedIn: 'root'
})
export class VisitService {

  private url = environment.API_URL;
  
    constructor(private http:HttpClient) { }

    listarVisitsIdPet(idPet: number) {
      let cuerpo = {
        accion: "ListarVisitasPet",
        id: idPet
      };
      return this.http.post<Visit[]>(this.url, cuerpo);
    }

    anadeVisit(visit: Visit) {
      let cuerpo = {
        accion: "AnadeVisit",
        visit: visit
      };
      return this.http.post(this.url, cuerpo);
    }

    borrarVisit(idVisit: number) {
      let cuerpo = {
        accion: "BorraVisit",
        id: idVisit
      };
      return this.http.post<any>(this.url, cuerpo);
    }

    obtenerVisitId(idVisit: number) {
      let cuerpo = {
        accion: "ObtenerVisitId",
        id: idVisit
      };
      return this.http.post<Visit>(this.url, cuerpo);
    }

    modificarVisit(visit: Visit) {
      let cuerpo = {
        accion: "ModificaVisit",
        visit: visit
      };
      return this.http.post(this.url, cuerpo);
    }
}
