import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { environment } from '../../environments/environment.development';
import { Vet } from '../modules/vet';
import { Specialtie } from '../modules/specialtie';

@Injectable({
  providedIn: 'root'
})
export class VetService {
  private url = environment.API_URL;
  
  constructor(private http:HttpClient) {}

  listarVets() {
    let cuerpo = {
      accion: "ListarVets"
    };
    return this.http.post<Vet[]>(this.url, cuerpo);
  }

  listarSpecialties() {
    let cuerpo = {
      accion: "ListarSpecialties"
    };
    return this.http.post<Specialtie[]>(this.url, cuerpo);
  }

  anadeVet(vet: Vet) {
    let cuerpo = {
      accion: "AnadeVet",
      vet: vet
    };
    return this.http.post(this.url, cuerpo);
  }
}
