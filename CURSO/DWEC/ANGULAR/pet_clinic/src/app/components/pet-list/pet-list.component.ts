import { Component, EventEmitter, Input, Output } from '@angular/core';
import { Pet } from '../../modules/pet';
import { VisitListComponent } from "../visit-list/visit-list.component";
import { PetService } from '../../services/pet.service';
import { Router } from '@angular/router';
import { RouterLink } from '@angular/router';

@Component({
  selector: 'app-pet-list',
  templateUrl: './pet-list.component.html',
  styleUrls: ['./pet-list.component.css'],
  imports: [VisitListComponent, RouterLink]
})
export class PetListComponent {
  @Input() pets: Pet[] = [];
  @Output() petDeleted = new EventEmitter<number>();

  constructor(private servicioPet: PetService, private route: Router) {}

  borrarPet(idPet: number, nombrePet: string) {
    if(confirm("¿Quieres eliminar a '"+nombrePet+"'?")) {
      this.servicioPet.borrarPet(idPet).subscribe(() => {
        console.log("Pet eliminado correctamente:", idPet);
        this.petDeleted.emit(idPet);
      },
      error => console.log("Error al borrar el pet :>> ", error));
    }
  }

  actualizarListaPets(idVisitDeleted: number) {
    console.log("idVisitDeleted :>> ", idVisitDeleted);

    this.pets.forEach(pet => {
      pet.visits = pet.visits.filter(visit => visit.id != idVisitDeleted);
    });
  }
  
}
