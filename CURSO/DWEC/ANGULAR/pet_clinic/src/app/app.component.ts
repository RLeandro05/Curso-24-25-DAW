import { Component } from '@angular/core';
import { ToolbarModule } from 'primeng/toolbar';
import { DropdownModule } from 'primeng/dropdown';
import { ButtonModule } from 'primeng/button';
import { FormsModule } from '@angular/forms';
import { RouterOutlet } from '@angular/router';
import { Router } from '@angular/router';

import { SelectModule } from 'primeng/select';

@Component({
  selector: 'app-root',
  standalone: true,
  templateUrl: './app.component.html',
  styleUrls: ['./app.component.css'],
  imports: [DropdownModule, ButtonModule, ToolbarModule, FormsModule, RouterOutlet, SelectModule]
})
export class AppComponent {
  title = 'Mi Aplicación PrimeNG';

  dropdown1Options = [
    { label: 'Owners', value: '1' },
    { label: 'Añadir Owner', value: '2' },
    { label: 'Opción 3', value: '3' }
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
      case "3":
        this.route.navigate(['/']);
    }
  }

  cambioDesplegableVeterinarios(event: any) {

  }

  cities: { name: string; code: string }[] = [
    { name: 'New York', code: 'NY' },
    { name: 'London', code: 'LDN' },
    { name: 'Paris', code: 'PAR' },
    { name: 'Berlin', code: 'BER' }
  ];

  selectedCity: { name: string; code: string } | null = null;
}
