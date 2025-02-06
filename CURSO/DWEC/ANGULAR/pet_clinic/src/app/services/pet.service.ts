import { Injectable } from '@angular/core';
import { environment } from '../../environments/environment.development';
import { HttpClient } from '@angular/common/http';
import { Pet } from '../modules/pet';
import { Pettype } from '../modules/pettype';

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

  listarPetTypes(){
    let cuerpo = {
      accion: "ListarPettypes"
    };
    return this.http.post<Pettype[]>(this.url, cuerpo);
  }

  anadePet(pet: Pet) {
    let cuerpo = {
      accion: "AnadePet",
      pet: pet
    };
    return this.http.post(this.url, cuerpo);
  }
}
