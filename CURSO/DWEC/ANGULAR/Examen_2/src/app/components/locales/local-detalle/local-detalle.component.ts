import { Component } from '@angular/core';
import { ActivatedRoute, Router } from '@angular/router';
import { LocalesService } from '../../../services/locales.service';
import { Local } from '../../../models/local';
import { RouterLink } from '@angular/router';
import { CartasListComponent } from "../../cartas/cartas-list/cartas-list.component";
import { CartasService } from '../../../services/cartas.service';

@Component({
  selector: 'app-local-detalle',
  imports: [RouterLink, CartasListComponent],
  templateUrl: './local-detalle.component.html',
  styleUrl: './local-detalle.component.css'
})
export class LocalDetalleComponent {
  public idLocalRoute: number = 0;
  public local: Local = <Local>{};
  public cartaMostrada: boolean = false;

  constructor(private route: Router, private activatedRoute: ActivatedRoute, private serviceLocales: LocalesService, private serviceCartas: CartasService) {}

  ngOnInit() {
    this.idLocalRoute = Number(this.activatedRoute.snapshot.params["idLocal"]);

    console.log("idLocalRoute :>> ", this.idLocalRoute);
    
    this.serviceLocales.obtenerLocalId(this.idLocalRoute).subscribe(
      datos => {
        this.local = datos;
        console.log("local traído :>> ", this.local);

        this.mostrarCarta();
      }, error => console.error("Error al obtenerLocalId :>> ", error)
    )
  }

  borrarLocal() {
    if(this.local.carta.length != 0) {
      alert("El local posee una carta. No puedes borrarlo");
    } else {
      if(confirm("¿Deseas eliminar el local "+this.local.nombre+"?")) {
        this.serviceLocales.borrarLocal(this.local.id).subscribe(
          datos => {
            console.log("Resultado :>> ", datos);
            
            this.route.navigate(['/']);
          }, error => console.error("Error al borrar el local :>> ", error)
        )
      }
    }
  }

  mostrarCarta() {
    this.cartaMostrada = !this.cartaMostrada;
  }

  actualizarListCarta(resultadoBorrado: any) {
    if(resultadoBorrado == "OK") {
      this.serviceCartas.obtenerCartaIdLocal(this.local.id).subscribe(
        datos => {
          this.local.carta = datos;
        }, error => console.error("Error al obtener la carta después de borrar una línea :>> ", error)
      )
    }
  }
}
