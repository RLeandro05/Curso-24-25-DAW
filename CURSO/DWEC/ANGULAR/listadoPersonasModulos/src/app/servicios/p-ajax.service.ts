import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Persona } from '../modelos/persona';

@Injectable({
  providedIn: 'root'
})
export class PAjaxService {

  private url: string = "http://localhost/Curso-24-25-DAW/CURSO/DWEC/ANGULAR/listadoPersonasModulos/BACKENDS/servidor.php";
  //Clase: http://localhost/Curso-24-25-DAW/CURSO/DWEC/ANGULAR/listadoPersonasModulos/BACKENDS/servidor.php
  //Casa: http://localhost/Curso-24-25-DAW/DWEC/ANGULAR/listadoPersonasModulos/BACKENDS/servidor.php

  constructor(private http:HttpClient) { }

  //Método para listar personas
  listarPersonas() {
    let cuerpo = JSON.stringify({
      servicio: "listar"
    });
    return this.http.post<Persona[]>(this.url, cuerpo);
  }

  //Método para borrar una persona específica
  borrarPersona(id: number) {
    let cuerpo = JSON.stringify({ //Crear el cuerpo de la petición
      servicio: "borrar",
      id: id
    });
    //Al ejecutar la petición en POST, este nos devolverá un dato convertido en array de tipo Persona
    return this.http.post<Persona[]>(this.url, cuerpo);
  }
}
