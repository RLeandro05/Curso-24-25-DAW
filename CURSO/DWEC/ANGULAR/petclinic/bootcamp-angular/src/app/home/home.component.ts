import { Component } from '@angular/core';
import { BorrarComponent } from '../borrar/borrar.component';
import { RouterLink } from '@angular/router';

@Component({
  selector: 'app-home',
  //imports: [BorrarComponent, RouterLink],
  templateUrl: './home.component.html',
  styleUrl: './home.component.css'
})
export class HomeComponent {
  public miAtributo:string = "This is my content in the attribute";

  public miObjeto = {
    nombre: "MiNombre",
    apellido: "MiApellido"
  };

  public miArray:String[] = ["Element1", "Element2", "Element3"];

  constructor() {
    console.log("Estoy en el segundo componente");
    
  }
}

