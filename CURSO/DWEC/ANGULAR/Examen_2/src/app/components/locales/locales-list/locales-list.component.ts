import { Component } from '@angular/core';
import { Local } from '../../../models/local';
import { LocalesService } from '../../../services/locales.service';
import { RouterLink } from '@angular/router';

@Component({
  selector: 'app-locales-list',
  imports: [RouterLink],
  templateUrl: './locales-list.component.html',
  styleUrl: './locales-list.component.css'
})
export class LocalesListComponent {
  public listLocales: Local[] = [];

  constructor(private serviceLocales: LocalesService) {}

  ngOnInit() {
    this.serviceLocales.listarLocales().subscribe(
      datos => {
        this.listLocales = datos;
        console.log("listLocales :>> ", this.listLocales);
        
      }, error => console.error("Error al obtener listLocales :>> ", error)
    )
  }
}
