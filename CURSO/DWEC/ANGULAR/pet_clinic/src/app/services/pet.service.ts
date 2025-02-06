import { Injectable } from '@angular/core';
import { environment } from '../../environments/environment.development';
import { HttpClient } from '@angular/common/http';
import { Pet } from '../modules/pet';

@Injectable({
  providedIn: 'root'
})
export class PetService {
  private url = environment.API_URL;

  constructor(private http:HttpClient) { }

  listarPetsIdOwner(idOwner: number) {
    let cuerpo = {
      accion: "ListarPetsOwnerId",
      id: idOwner
    };
    return this.http.post<Pet[]>(this.url, cuerpo);
  }
}
