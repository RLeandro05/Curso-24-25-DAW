import { Component } from '@angular/core';
import { OwnerService } from '../../services/owner.service';
import { CommonModule } from '@angular/common';
import { Owner } from '../../modules/owner';
import { RouterLink } from '@angular/router';

@Component({
  selector: 'app-owners',
  imports: [CommonModule, RouterLink],
  templateUrl: './owners.component.html',
  styleUrl: './owners.component.css'
})
export class OwnersComponent {
  owners: Owner[] = [];
  personas: any[] = [];

  constructor(private servicioOwner: OwnerService) {}

  ngOnInit() {
    //Obtener los owners llamando al servicioPAjax
    this.servicioOwner.getOwners().subscribe({
      next: datos => { 
        console.log("Propietarios recibidos: ", datos);
        this.owners = datos;
      },
      error: error => console.log("Error al obtener propietarios: ", error)
    });
  }

  /*borrarOwner(owner: Owner) {
    console.log("idOwner :>> ", owner.id);

    if(confirm("¿Estás seguro de que deseas eliminar a "+owner.firstName+" "+owner.lastName+"?")) {
      this.servicioOwner.borrarOwner(owner.id).subscribe(
        datos => {
          this.owners = datos;
          
        }
      )
    }
  }*/
}
