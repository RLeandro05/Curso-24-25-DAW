import { Component } from '@angular/core';
import { ActivatedRoute, Router } from '@angular/router';
import { Owner } from '../../modules/owner';
import { OwnerService } from '../../services/owner.service';
import { RouterLink } from '@angular/router';
import { PetService } from '../../services/pet.service';
import { Pet } from '../../modules/pet';
import { PetListComponent } from "../pet-list/pet-list.component";

@Component({
  selector: 'app-detail-owner',
  imports: [RouterLink, PetListComponent],
  templateUrl: './detail-owner.component.html',
  styleUrl: './detail-owner.component.css'
})
export class DetailOwnerComponent {
  public idOwner: number = 0;
  public owner: Owner = <Owner>{};
  public pets: Pet[] = [];

  constructor(private activatedRoute: ActivatedRoute, private servicioOwner: OwnerService, private servicioPet: PetService, private ruta: Router) {
    this.idOwner = activatedRoute.snapshot.params["id"];

    console.log("idOwner :>> ", this.idOwner);
    
    this.servicioOwner.obtenerOwnerId(this.idOwner).subscribe(
      datos => {
        this.owner = datos;
        console.log("Owner :>> ", this.owner);
      }
    )

    this.servicioPet.listarPetsIdOwner(this.idOwner).subscribe(
      datos => {
        this.pets = datos;
        console.log("Pets :>> ", this.pets);
        
      }
    )
  }

  borrarOwner(owner: Owner) {
    if(confirm("¿Quieres eliminar a "+owner.firstName+" "+owner.lastName+"?")) {
      if(this.pets.length != 0) {
        alert("El owner posee pets y no puede eliminarse.");
      } else {
        this.servicioOwner.borrarOwner(owner.id).subscribe(() => {
          setTimeout(() => {
            this.ruta.navigate(['/']);
          }, 1000);
        });
      }
    }
  }

  actualizarLista(idPet: number) {
    this.pets = this.pets.filter(pet => pet.id !== idPet);
  }
}
