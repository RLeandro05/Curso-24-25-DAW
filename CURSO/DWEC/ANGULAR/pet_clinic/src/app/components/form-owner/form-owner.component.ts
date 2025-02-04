import { Component } from '@angular/core';
import { FormsModule } from '@angular/forms';
import { Owner } from '../../modules/owner';
import { Router, RouterLink } from '@angular/router';
import { OwnerService } from '../../services/owner.service';

@Component({
  selector: 'app-form-owner',
  imports: [FormsModule, RouterLink],
  templateUrl: './form-owner.component.html',
  styleUrl: './form-owner.component.css'
})
export class FormOwnerComponent {
  public owner: Owner = <Owner>{};
  public listaOwners: Owner[] = [];

  constructor(private servicioOwner: OwnerService, private ruta: Router) {
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
    
    this.servicioOwner.aniadirOwner(owner).subscribe({
      next: datos => {
        this.listaOwners = datos;
        console.log("listaOwners :>> ", this.listaOwners);
        
        this.ruta.navigate(["/"]);
      },
      error: error => {
        console.log("Error: ", error);
        
      }
    }
    )
  }
}
