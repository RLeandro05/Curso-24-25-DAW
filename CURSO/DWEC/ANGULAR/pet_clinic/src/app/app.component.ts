import { Component } from '@angular/core';
import { ToolbarModule } from 'primeng/toolbar';
import { DropdownModule } from 'primeng/dropdown';
import { ButtonModule } from 'primeng/button';
import { FormsModule } from '@angular/forms';
import { RouterOutlet } from '@angular/router';
import { Router } from '@angular/router';

@Component({
  selector: 'app-root',
  standalone: true,
  templateUrl: './app.component.html',
  styleUrls: ['./app.component.css'],
  imports: [DropdownModule, ButtonModule, ToolbarModule, FormsModule, RouterOutlet]
})
export class AppComponent {
  title = 'Mi Aplicación PrimeNG';

  dropdown1Options = [
    { label: 'Owners', value: '1' },
    { label: 'Añadir Owner', value: '2' },
  ];

  dropdown2Options = [
    { label: 'Veterinarios', value: 'A' },
    { label: 'Añadir Veterinario', value: 'B' }
  ];

  // Inicializamos las variables con valores válidos
  selectedOption1: string = '1'; // Valor por defecto para el primer dropdown
  selectedOption2: string = 'A'; // Valor por defecto para el segundo dropdown

  constructor (private route: Router) {}

  cambioDesplegableOwners(event: any) {
    const seleccion = event.value;

    switch (seleccion) {
      case "1":
        this.route.navigate(['/']);
        break;
      case "2":
        this.route.navigate(['/form-owner', -1]);
        break;
    }
  }

  cambioDesplegableVeterinarios(event: any) {
    const seleccion = event.value;

    switch (seleccion) {
      case "A":
        this.route.navigate(['/vets']);
        break;
      case "B":
        this.route.navigate(['/form-vet', -1]);
        break;
    }
  }
}
