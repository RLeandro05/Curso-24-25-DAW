import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Persona } from '../modelos/persona';

@Injectable({
  providedIn: 'root'
})
export class PAjaxService {

  private url: string = "http://localhost/Curso-24-25-DAW/CURSO/DWEC/ANGULAR/listadoPersonasModulos/BACKENDS/servidor.php";
  //http://localhost/Curso-24-25-DAW/CURSO/DWEC/ANGULAR/listadoPersonasModulos/BACKENDS/servidor.php

  constructor(private http:HttpClient) { }

  listarPersonas() {
    let cuerpo = JSON.stringify({
      servicio: "listar"
    });
    return this.http.post<Persona[]>(this.url, cuerpo);
  }

  /*listarPersonas() {
    let pa = JSON.stringify({
      servicio: "listar"
    })
    return this.http.post<Persona[]>(this.url, pa);
  }*/
}
