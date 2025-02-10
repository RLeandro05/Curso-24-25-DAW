import { Component } from '@angular/core';
import { ToolbarModule } from 'primeng/toolbar';
import { DropdownModule } from 'primeng/dropdown';
import { ButtonModule } from 'primeng/button';
import { FormsModule } from '@angular/forms';
import { RouterOutlet } from '@angular/router';

@Component({
  selector: 'app-root',
  standalone: true,
  templateUrl: './app.component.html',
  styleUrls: ['./app.component.css'],
  imports: [DropdownModule, ButtonModule, ToolbarModule, FormsModule, RouterOutlet]
})
export class AppComponent {
  title = 'Mi Aplicación PrimeNG';

  // Opciones para los dropdowns
  dropdown1Options = [
    { label: 'Listar Owners', value: '1' },
    { label: 'Añadir Owner', value: '2' },
    { label: 'Opción 3', value: '3' }
  ];

  dropdown2Options = [
    { label: 'Opción A', value: 'A' },
    { label: 'Opción B', value: 'B' }
  ];

  // Inicializamos las variables con valores válidos
  selectedOption1: string = '1'; // Valor por defecto para el primer dropdown
  selectedOption2: string = 'A'; // Valor por defecto para el segundo dropdown
}
