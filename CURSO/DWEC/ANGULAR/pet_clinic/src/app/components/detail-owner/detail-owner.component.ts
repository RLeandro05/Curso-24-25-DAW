import { Component } from '@angular/core';
import { ActivatedRoute, Router } from '@angular/router';
import { Owner } from '../../modules/owner';
import { OwnerService } from '../../services/owner.service';
import { RouterLink } from '@angular/router';

@Component({
  selector: 'app-detail-owner',
  imports: [RouterLink],
  templateUrl: './detail-owner.component.html',
  styleUrl: './detail-owner.component.css'
})
export class DetailOwnerComponent {
  public idOwner: number = 0;
  public owner: Owner = <Owner>{};

  constructor(private activatedRoute: ActivatedRoute, private servicioOwner: OwnerService, private ruta: Router) {
    this.idOwner = activatedRoute.snapshot.params["id"];

    console.log("idOwner :>> ", this.idOwner);
    
    this.servicioOwner.obtenerOwnerId(this.idOwner).subscribe(
      datos => {
        this.owner = datos;
        console.log("Owner :>> ", this.owner);
      }
    )
  }

  borrarOwner(owner: Owner) {
    if(confirm("¿Quieres eliminar a "+owner.firstName+" "+owner.lastName+"?")) {
      this.servicioOwner.borrarOwner(owner.id).subscribe(
        datos => {
          this.ruta.navigate(['/']);
        }
      )
    }
  }
}
