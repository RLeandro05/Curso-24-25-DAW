import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';

@Injectable({
  providedIn: 'root'
})

export class PAjaxService {

  private url: string = "http://localhost/Curso-24-25-DAW/DWEC/ANGULAR/petclinic/servicios.php";

  constructor(private http:HttpClient) { }

  getOwners(){
    let cuerpo = {
      accion: "ListarOwners"
    };
    return this.http.post(this.url, cuerpo);
  }

  /*
  getPersonas() {
    let cuerpo = {
      servicio: "listar"
    };
    return this.http.post(this.url, cuerpo);
  }*/
  
}
