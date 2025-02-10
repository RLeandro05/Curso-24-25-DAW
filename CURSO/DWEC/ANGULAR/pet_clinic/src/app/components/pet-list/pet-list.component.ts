import { Component, Input } from '@angular/core';
import { Pet } from '../../modules/pet';
import { VisitListComponent } from "../visit-list/visit-list.component";

@Component({
  selector: 'app-pet-list',
  templateUrl: './pet-list.component.html',
  styleUrls: ['./pet-list.component.css'],
  imports: [VisitListComponent]
})
export class PetListComponent {
  @Input() pets: Pet[] = [];

  constructor() {}
}
