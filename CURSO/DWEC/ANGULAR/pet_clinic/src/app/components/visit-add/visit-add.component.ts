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
  public visit: Visit = <Visit>{};
  public textoBoton: string = "Guardar";

  constructor(private servicioVisit:VisitService, private activatedRoute: ActivatedRoute, private route: Router) {
    this.idPetRoute = Number(activatedRoute.snapshot.params["idPet"]);
    this.idOwnerRoute = Number(activatedRoute.snapshot.params["idOwner"]);

    console.log("idPetRoute :>> ", this.idPetRoute);

    this.visit = {
      id: -1,
      petId: this.idPetRoute,
      visitDate: null,
      description: ""
    }
  }

  onSubmit(visitForm: Visit) {
    console.log("visitForm :>> ", visitForm);
    
    this.servicioVisit.anadeVisit(visitForm).subscribe();

    this.route.navigate(['/detail-owner', this.idOwnerRoute]);
  }
}
