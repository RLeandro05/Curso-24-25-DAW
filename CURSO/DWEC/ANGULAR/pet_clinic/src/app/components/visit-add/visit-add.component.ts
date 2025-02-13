import { Component } from '@angular/core';
import { VisitService } from '../../services/visit.service';
import { ActivatedRoute, Router } from '@angular/router';
import { Visit } from '../../modules/visit';
import { FormsModule } from '@angular/forms';
import { RouterLink } from '@angular/router';

@Component({
  selector: 'app-visit-add',
  imports: [FormsModule, RouterLink],
  templateUrl: './visit-add.component.html',
  styleUrl: './visit-add.component.css'
})
export class VisitAddComponent {
  public idPetRoute: number = 0;
  public idOwnerRoute: number = 0;
  public idVisitRoute: number = 0;
  public visit: Visit = <Visit>{};
  public textoBoton: string = "Guardar";

  constructor(private servicioVisit:VisitService, private activatedRoute: ActivatedRoute, private route: Router) {
  }

  ngOnInit() {
    this.idPetRoute = Number(this.activatedRoute.snapshot.params["idPet"]);
    this.idOwnerRoute = Number(this.activatedRoute.snapshot.params["idOwner"]);
    this.idVisitRoute = Number(this.activatedRoute.snapshot.params["idVisit"]);

    console.log("idPetRoute :>> ", this.idPetRoute);
    console.log("idOwnerRoute :>> ", this.idOwnerRoute);
    console.log("idPetVisit :>> ", this.idVisitRoute);

    if(this.idVisitRoute == -1) {
      this.visit = {
        id: -1,
        petId: this.idPetRoute,
        visitDate: null,
        description: ""
      }
    } else {
      this.servicioVisit.obtenerVisitId(this.idVisitRoute).subscribe(
        datos => {
          this.visit = datos;

          console.log("Visit traído de obtenerVisitId :>> ", this.visit);
          
        },
        error => console.log("Error al obtenerVisitId :>> ", error)
      );
      
    }
  }

  onSubmit(visitForm: Visit) {
    console.log("visitForm :>> ", visitForm);

    if(this.idVisitRoute == -1) {
      this.servicioVisit.anadeVisit(visitForm).subscribe();

      this.route.navigate(['/detail-owner', this.idOwnerRoute]);
    } else {
      this.servicioVisit.modificarVisit(visitForm).subscribe();

      this.route.navigate(['detail-owner', this.idOwnerRoute]);
    }
  }
}
