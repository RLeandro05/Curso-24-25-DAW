import { Component } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';
import { VetService } from '../../services/vet.service';
import { Vet } from '../../modules/vet';
import { Specialtie } from '../../modules/specialtie';
import { ActivatedRoute, Router, RouterLink } from '@angular/router';

@Component({
  selector: 'app-vet-add',
  standalone: true,
  imports: [CommonModule, FormsModule, RouterLink],
  templateUrl: './vet-add.component.html',
  styleUrl: './vet-add.component.css'
})
export class VetAddComponent {
  public idVetRoute: number = 0;
  public vet: Vet = <Vet>{};
  public specialties: Specialtie[] = [];

  constructor(private serviceVet: VetService, private activatedRoute: ActivatedRoute, private route: Router) {}

  ngOnInit() {
    const idParam = Number(this.activatedRoute.snapshot.params["idVet"]); // Obtener el parámetro de la ruta
    this.idVetRoute = idParam;
    console.log('idVetRoute :>> ', this.idVetRoute);

    this.vet = {
      id: -1,
      firstName: '',
      lastName: '',
      specialties: []
    };

    this.serviceVet.listarSpecialties().subscribe(
      datos => {
        this.specialties = datos; // Cargar todas las especialidades disponibles
        console.log('specialties :>> ', this.specialties);

        if (this.idVetRoute != -1) {
          this.serviceVet.obtenerVetId(this.idVetRoute).subscribe(
            datos => {
              this.vet = datos;
              console.log("Vet a modificar :>> ", this.vet);
            },
            error => console.log("Error al obtener Vet :>> ", error)
          );
        }
      },
      error => console.error('Error al obtener specialties :>> ', error)
    );
  }

  toggleSpecialty(specialty: Specialtie) {
    //Encontrar el índice de la especialidad por su nombre
    const index = this.vet.specialties.findIndex(s => s.name === specialty.name);
  
    if (index === -1) {
      //Si no está seleccionada, agregarla
      this.vet.specialties.push(specialty); // Clonar el objeto para evitar mutaciones
    } else {
      //Si ya está seleccionada, removerla
      this.vet.specialties.splice(index, 1);
    }
  
    console.log('Especialidades seleccionadas:', this.vet.specialties);
  }

  isChecked(specialtyName: string) {
    //console.log("specialtyName :>> ", specialtyName);
    
    for (let i = 0; i < this.vet.specialties.length; i++) {
      const specialty = this.vet.specialties[i];
      if(specialty.name === specialtyName) {
        return true;
      }
    }

    return false;
  }

  onSubmit(vetForm: Vet) {
    vetForm.specialties = this.vet.specialties;

    for (let i = 0; i < vetForm.specialties.length; i++) {
      const element = vetForm.specialties[i];
      element.idVet = vetForm.id;
    }

    if (this.idVetRoute == -1) {
      console.log('vetForm nuevo :>> ', vetForm);
      
      this.serviceVet.anadeVet(vetForm).subscribe();

      this.route.navigate(['/vets']);
    } else {
      console.log('vetForm modificado :>> ', vetForm);

      this.serviceVet.modificaVet(vetForm).subscribe();

      this.route.navigate(['/vets']);
    }
  }
}