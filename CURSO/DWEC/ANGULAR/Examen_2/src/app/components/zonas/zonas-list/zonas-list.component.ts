import { Component } from '@angular/core';
import { ActivatedRoute } from '@angular/router';
import { Zona } from '../../../models/zona';
import { ZonasService } from '../../../services/zonas.service';
import { RouterLink } from '@angular/router';
import { ZonasFormComponent } from "../zonas-form/zonas-form.component";

@Component({
  selector: 'app-zonas-list',
  imports: [RouterLink, ZonasFormComponent],
  templateUrl: './zonas-list.component.html',
  styleUrl: './zonas-list.component.css'
})
export class ZonasListComponent {
  public idLocalRoute: number = 0;
  public listZonas: Zona[] = [];
  public formMostrado: boolean = false;
  public zona: Zona = <Zona>{};

  constructor(private activatedRoute: ActivatedRoute, private serviceZonas: ZonasService) {
    this.zona = {
      id: -1,
      nombre: ""
    }
  }

  ngOnInit() {
    this.idLocalRoute = Number(this.activatedRoute.snapshot.params['idLocal']);

    console.log("idLocalRoute :>> ", this.idLocalRoute);
    
    this.serviceZonas.listarZonas().subscribe(
      datos => {
        this.listZonas = datos;

        console.log("listZonas :>> ", this.listZonas);
      }, error => console.error("Error al obtener listZonas :>> ", error)
    )
  }

  borrarZona(zona: Zona) {
    if(confirm("¿Desea eliminar la zona '"+zona.nombre+"'?")) {
      this.serviceZonas.borraZona(zona.id).subscribe(
        datos => {
          this.listZonas = datos;
          console.log("listZonas después de borrar :>> ", this.listZonas);
        }, error => console.error("Error al borrar la zona especificada :>> ", error)
      )
    }
  }

  cambiarZona(zona: Zona) {
    this.zona = zona;

    this.mostrarFormulario();
  }

  anadirZona() {
    this.zona = {
      id: -1,
      nombre: ""
    }

    this.mostrarFormulario();
  }

  mostrarFormulario() {
    this.formMostrado = !this.formMostrado;
  }

  anadirOeditar_zona(zonaTraida: Zona) {
    console.log("zonaTraida desde el hijo :>> ", zonaTraida);
    
    if(zonaTraida.id === -1) {
      
      this.serviceZonas.anadirZona(zonaTraida).subscribe(
        datos => {
          console.log("Resultado :>> ", datos);
          
          this.serviceZonas.listarZonas().subscribe(
            datos => {
              this.listZonas = datos
            }, error => console.error("Error al actualizar listZonas después de añadir :>> ", error)
          )
        }, error => console.error("Error al añadir una nueva zona :>> ", error)
      )
    } else {
      this.serviceZonas.modificaZona(zonaTraida).subscribe(
        datos => {
          console.log("Resultado :>> ", datos);
          
          this.serviceZonas.listarZonas().subscribe(
            datos => {
              this.listZonas = datos
            }, error => console.error("Error al actualizar listZonas después de modificar :>> ", error)
          )
        }, error => console.error("Error al modifica una zona :>> ", error)
      )
    }

    this.mostrarFormulario();
  }
}
