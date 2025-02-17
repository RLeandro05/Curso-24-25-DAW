import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { environment } from '../../environments/environment.development';
import { Vet } from '../modules/vet';

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
    return this.http.post<any[]>(this.url, cuerpo);
  }
}
