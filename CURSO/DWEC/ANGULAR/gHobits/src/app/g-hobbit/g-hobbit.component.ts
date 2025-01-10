import { Component } from '@angular/core';

@Component({
  selector: 'app-g-hobbit',
  standalone: false,
  
  templateUrl: './g-hobbit.component.html',
  styleUrl: './g-hobbit.component.css'
})
export class GHobbitComponent {
  //Array de String
  public lista: string[];

  //Atributo String
  public gHobbit: string;

  //Objeto
  private accion: {
      id: number, 
      nombre: string, 
      indice: number
  };

  constructor() {
    this.lista = ["Bilbo Bolsón", "Sam Gamyi", "Frodo Bolsón"];
    this.gHobbit = "";
    this.accion = {id:1, nombre:"Añadir", indice:-1};
  }
}
