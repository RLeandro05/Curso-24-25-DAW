import { Component } from '@angular/core';
import { FormsModule } from '@angular/forms';
import { Owner } from '../../modules/owner';
import { ActivatedRoute, Router, RouterLink } from '@angular/router';
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
  public textoBoton: string = "Añadir Owner";
  public idOwnerTraido: number = 0;

  constructor(private servicioOwner: OwnerService, private ruta: Router, private activatedRoute: ActivatedRoute) {
    this.idOwnerTraido = Number(this.activatedRoute.snapshot.params["id"]);
    if (this.idOwnerTraido == -1) {
      this.owner = {
        id: -1,
        firstName: "",
        lastName: "",
        address: "",
        city: "",
        telephone: "",
        pets: []
      }

      this.textoBoton = "Añadir Owner";
    } else {
      this.servicioOwner.obtenerOwnerId(this.idOwnerTraido).subscribe(
        ownerTraido => {
          this.owner = {
            id: ownerTraido["id"],
            firstName: ownerTraido["firstName"],
            lastName: ownerTraido["lastName"],
            address: ownerTraido["address"],
            city: ownerTraido["city"],
            telephone: ownerTraido["telephone"],
            pets: []
          }
        }
      );

      this.textoBoton = "Modificar Owner";
    }
    
  }

  onSubmit(owner: Owner) {
    console.log("owner :>> ", owner);
    console.log("ownerId :>> ", owner["id"]);
    

    if (owner["id"] == -1) {
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
      );
    } else {
      this.servicioOwner.modificarOwner(owner).subscribe(
        datos => {
          this.listaOwners = datos;
          console.log("listaOwners :>> ", this.listaOwners);
          
          this.ruta.navigate(["/"]);
        }
      )
    }
  }
}
