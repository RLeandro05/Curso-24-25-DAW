import { Component, EventEmitter, Input, Output } from '@angular/core';
import { Carta } from '../../../models/carta';
import { CurrencyPipe } from '@angular/common';
import { CartasService } from '../../../services/cartas.service';
import { RouterLink } from '@angular/router';

@Component({
  selector: 'app-cartas-list',
  imports: [CurrencyPipe, RouterLink],
  templateUrl: './cartas-list.component.html',
  styleUrl: './cartas-list.component.css'
})
export class CartasListComponent {
  @Input() listCarta: Carta[] = [];
  @Output() resultadoBorrado = new EventEmitter<any>();

  public idLocal: number = 0;

  constructor(private serviceCartas: CartasService) {
  }

  ngOnInit() {
    console.log("listCarta :>> ", this.listCarta);

    if(this.listCarta.length != 0) {
      this.idLocal = this.listCarta[0].id_local;

      console.log("idLocal en cartas-list :>> ", this.idLocal);
    }
  }

  borrarLineaCarta(lineaCarta: Carta) {
    if(confirm("Deseas eliminar de la carta '"+lineaCarta.descripcion+"'?")){
      this.serviceCartas.borrarLineaCarta(lineaCarta.id).subscribe(
        datos => {
          console.log("Resultado :>> ", datos);

          this.resultadoBorrado.emit("OK");
        }, error => console.error("Error al borrar la línea de la carta")
      )
    }
  }
}
