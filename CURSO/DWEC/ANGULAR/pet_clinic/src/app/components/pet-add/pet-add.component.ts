import { Component, OnInit } from '@angular/core';
import { ActivatedRoute, Router } from '@angular/router';
import { Pet } from '../../modules/pet';
import { Owner } from '../../modules/owner';
import { FormsModule } from '@angular/forms';
import { RouterLink } from '@angular/router';
import { OwnerService } from '../../services/owner.service';
import { PetService } from '../../services/pet.service';
import { Pettype } from '../../modules/pettype';

@Component({
  selector: 'app-pet-add',
  imports: [FormsModule, RouterLink],
  templateUrl: './pet-add.component.html',
  styleUrl: './pet-add.component.css'
})
export class PetAddComponent implements OnInit {
  public idOwnerTraido: number = 0;
  public ownerTraido: Owner = <Owner>{};
  public pet: Pet = <Pet>{};
  public petTypes: Pettype[] = [];

  constructor(private activatedRoute: ActivatedRoute, private servicioOwner: OwnerService, private servicioPet: PetService, private ruta: Router) {
    this.pet = {
      id: -1,
      name: "",
      birthDate: null,
      owner: {} as Owner,
      type: {} as Pettype,
      visits: []
    };

    this.servicioPet.listarPetTypes().subscribe(
      datos => {
        this.petTypes = datos;
        console.log("petTypes :>> ", this.petTypes);
        
      }
    )
  }

  ngOnInit() {
    this.idOwnerTraido = Number(this.activatedRoute.snapshot.params['idOwner']);
    console.log('idOwnerTraido :>> ', this.idOwnerTraido);

    this.servicioOwner.obtenerOwnerId(this.idOwnerTraido).subscribe(
      (datos) => {
        this.ownerTraido = datos;
        console.log('owner :>> ', this.ownerTraido);

        this.pet.owner = this.ownerTraido;
        
        console.log('pet :>> ', this.pet);
      },
      (error) => {
        console.error('Error al obtener el propietario:', error);
      }
    );
  }

  onSubmit(petTraido: Pet): void {
    console.log("petTraido :>> ", petTraido);
    
    //this.servicioPet.anadePet(petTraido).subscribe();
  }
}