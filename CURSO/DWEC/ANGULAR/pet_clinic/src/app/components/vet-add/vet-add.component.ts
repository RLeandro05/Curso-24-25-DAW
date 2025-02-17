import { Component } from '@angular/core';
import { VetService } from '../../services/vet.service';
import { ActivatedRoute } from '@angular/router';
import { Vet } from '../../modules/vet';
import { FormsModule } from '@angular/forms';
import { RouterLink } from '@angular/router';

@Component({
  selector: 'app-vet-add',
  imports: [FormsModule, RouterLink],
  templateUrl: './vet-add.component.html',
  styleUrl: './vet-add.component.css'
})
export class VetAddComponent {
  public idVetRoute: number = 0;
  public vet: Vet = <Vet>{};
  public specialties: any[] = [];
  
  constructor(private serviceVet: VetService, private activatedRoute: ActivatedRoute) {}

  ngOnInit() {
    this.idVetRoute = Number(this.activatedRoute.snapshot.params["idVet"]);
    console.log("idVetRoute :>> ", this.idVetRoute);

    this.serviceVet.listarSpecialties().subscribe(
      datos => {
        this.specialties = datos;
        console.log("specialties :>> ", this.specialties);
        
      },
      error => console.log("Error al obtener specialties :>> ", error)
    );

    if (this.idVetRoute == -1) {
      this.vet = {
        id: -1,
        firstName: "",
        lastName: "",
        specialties: this.specialties
      }
    }
  }

  onSubmit(vetForm: Vet) {
    if (this.idVetRoute == -1) {

    }
  }
}
