import { HttpClient, HttpHeaders } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { Pet } from '../modules/pet';
import { Owner } from '../modules/owner';
import { environment } from '../../environments/environment.development';

@Injectable({
  providedIn: 'root'
})
export class OwnerService {
  private url = environment.API_URL;
  //Clase: "http://localhost/Curso-24-25-DAW/CURSO/DWEC/ANGULAR/pet_clinic/BACKENDS/servicios.php";
  //Casa: "";

  constructor(private http:HttpClient) { }

  getOwners(){
    let cuerpo = {
      accion: "ListarOwners"
    };
    return this.http.post<Owner[]>(this.url, JSON.stringify(cuerpo));
  }

  aniadirOwner(owner: Owner) {
    let cuerpo = {
      accion: "AnadeOwner",
      owner: owner
    };
    return this.http.post<Owner[]>(this.url, cuerpo);
  }

  /*
  getPersonas() {
    let cuerpo = {
      servicio: "listar"
    };
    return this.http.post(this.url, cuerpo);
  }*/
}
