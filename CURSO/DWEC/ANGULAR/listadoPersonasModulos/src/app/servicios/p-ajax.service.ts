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

  /*aniadirPersona(persona: Persona) {
    let cuerpo = JSON.stringify({ //Crear el cuerpo de la petición
      servicio: "insertar",
      dni: persona.DNI,
      nombre: persona.NOMBRE,
      apellidos: persona.APELLIDOS,
    });

    return this.http.post<Persona[]>(this.url, cuerpo);
  }*/

  //Método para insertar una nueva persona del formulario
  aniadirPersona(persona: Persona) {
    let pa = JSON.parse(JSON.stringify(persona));

    pa.servicio = "insertar";
    console.log(pa);
    
    return this.http.post<Persona[]>(this.url, pa);
  }

  //Método para obtener la persona con el id dado
  selPersonaID(id: number) {
    let cuerpo = JSON.stringify({
      servicio: "selPersonaID",
      id: id
    });
    
    //Devolver de la consulta la persona seleccionada con el id
    return this.http.post<Persona>(this.url, cuerpo);
  }

  //Método para modificar la persona antes seleccioanda en selPersonaID
  modificarPersona(persona: Persona) {
    let pa = JSON.parse(JSON.stringify(persona));
    pa.servicio = "modificar";

    return this.http.post<Persona[]>(this.url, pa);
  }
}
