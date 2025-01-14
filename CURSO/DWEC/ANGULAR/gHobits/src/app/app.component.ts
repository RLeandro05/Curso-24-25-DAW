import { Component } from '@angular/core';

@Component({
  selector: 'app-root',
  templateUrl: './app.component.html',
  standalone: false,
  styleUrl: './app.component.css'
})
export class AppComponent {
  public lista: string[];
  public gHobbit: string;
  public gHobbitMod: string;
  public idEdit: number = -1;
  //private accion: Object;
  private accion : {id: number, nombre:string, indice:number};

  constructor(){
    this.lista = ["Bilbo Bolson", "Sam Gmyi", "Frodo Bolson", "Pippin Pladin", "Mrry Brandigamo", "Rosita Goto"];
    this.gHobbit= "";
    this.gHobbitMod= "";
    this.accion= {id:1, nombre:"Añadir", indice:-1};
  }


  eliminar(hobbit:string, i:number){
    console.log("llega. hobbit: ",hobbit, "i: ",i);
    if (confirm("¿Estás seguro de que deseas eliminar a "+hobbit+"?")) {
      this.lista.splice(i, 1);
    }
  }

  anade() {
    console.log("Llega a anade, ", this.gHobbit);

    if (this.gHobbit.trim() == "") {
      alert("Está vacío");
    } else {
      this.lista.push(this.gHobbit);
    }

    this.gHobbit = "";
  }

  editar(hobbit:string, i:number) {
    console.log("Llega a modificar, ", hobbit, i);

    this.gHobbitMod = hobbit;
    this.idEdit = i;
  }

  modificar() {
    this.lista[this.idEdit] = this.gHobbitMod;
  }
}
