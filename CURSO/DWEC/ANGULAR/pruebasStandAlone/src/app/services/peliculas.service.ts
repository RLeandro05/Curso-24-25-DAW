import { Injectable } from '@angular/core';
import { environment } from '../environments/environment.development';
import { HttpClient } from '@angular/common/http';
import { Pelicula } from '../models/pelicula';

@Injectable({
  providedIn: 'root'
})
export class PeliculasService {
  private url: string = environment.API_URL;

  constructor(private http:HttpClient) { }

  listarPeliculas() {
    let cuerpo = {
      accion: "ListarPeliculas"
    };
    return this.http.post<Pelicula[]>(this.url, cuerpo);
  }

  borrarPelicula(idPelicula: number) {
    let cuerpo = {
      accion: "BorrarPelicula",
      id: idPelicula
    };
    return this.http.post<Pelicula[]>(this.url, cuerpo);
  }
}
