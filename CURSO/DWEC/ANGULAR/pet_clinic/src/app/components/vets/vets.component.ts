import { Component } from '@angular/core';
import { VetService } from '../../services/vet.service';
import { Vet } from '../../modules/vet';
import { RouterLink } from '@angular/router';

@Component({
  selector: 'app-vets',
  imports: [RouterLink],
  templateUrl: './vets.component.html',
  styleUrl: './vets.component.css'
})
export class VetsComponent {
  public vets: Vet[] = [];

  constructor(private servicioVet: VetService) {}

  ngOnInit() {
    this.servicioVet.listarVets().subscribe(
      datos => {
        this.vets = datos;

        console.log("vets :>> ", this.vets);
        
      },
      error => console.log("Error al obtener listado de vets :>> ", error)
    )
  }
}
