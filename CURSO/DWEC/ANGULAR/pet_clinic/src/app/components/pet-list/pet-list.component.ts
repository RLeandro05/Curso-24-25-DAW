import { Component, EventEmitter, Input, Output } from '@angular/core';
import { Pet } from '../../modules/pet';
import { VisitListComponent } from "../visit-list/visit-list.component";
import { PetService } from '../../services/pet.service';
import { Router } from '@angular/router';

@Component({
  selector: 'app-pet-list',
  templateUrl: './pet-list.component.html',
  styleUrls: ['./pet-list.component.css'],
  imports: [VisitListComponent]
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

  irAPetAdd(petAIrse: Pet) {
    //console.log("idOwner :>> ", idOwner);
    //console.log("pets :>> ", this.pets);
    
    
    //this.route.navigate(["/pet-add", idOwner]);
  }
  
}
