import { Component } from '@angular/core';
import { FormsModule } from '@angular/forms';
import { Owner } from '../../modules/owner';
import { RouterLink } from '@angular/router';

@Component({
  selector: 'app-form-owner',
  imports: [FormsModule, RouterLink],
  templateUrl: './form-owner.component.html',
  styleUrl: './form-owner.component.css'
})
export class FormOwnerComponent {
  public owner: Owner = <Owner>{};

  constructor() {
    this.owner = {
      id: -1,
      firstName: "",
      lastName: "",
      address: "",
      city: "",
      telephone: "",
      pets: []
    }
  }

  onSubmit(owner: Owner) {
    console.log("owner :>> ", owner);
    
  }
}
