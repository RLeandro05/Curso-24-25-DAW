import { Component, OnInit } from '@angular/core';
import { PAjaxService } from '../p-ajax.service';
import { CommonModule } from '@angular/common';

@Component({
  selector: 'app-owners',
  imports: [CommonModule],
  templateUrl: './owners.component.html',
  styleUrls: ['./owners.component.css']
})
export class OwnersComponent implements OnInit {

  owners: any[] = [];
  personas: any[] = [];

  constructor(private servicioPAjax: PAjaxService) {}

  ngOnInit() {
    // Obtener la lista de propietarios (owners)
    this.servicioPAjax.getOwners().subscribe({
      next: res => {
        console.log("Propietarios recibidos: ", res);
        this.owners = res as any[];
      },
      error: error => console.log("Error al obtener propietarios: ", error)
    });


    /*
    // Obtener la lista de personas
    this.servicioPAjax.getPersonas().subscribe({
      next: res => {
        console.log("Personas recibidas: ", res);
        this.personas = res as any[];
      },
      error: error => console.log("Error al obtener personas: ", error)
    });
    */
  }
}
