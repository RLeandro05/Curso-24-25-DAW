import { Component } from '@angular/core';
import { VetService } from '../../services/vet.service';
import { Vet } from '../../modules/vet';
import { RouterLink } from '@angular/router';
import { Specialtie } from '../../modules/specialtie';

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

  borrarVet(vet: Vet) {
    if(confirm("¿Deseas eliminar a '"+vet.firstName+" "+vet.lastName+"'?")) {
      this.servicioVet.borraVet(vet.id).subscribe();
      this.vets = this.vets.filter(vete => vete.id != vet.id);
    }
  }
}
