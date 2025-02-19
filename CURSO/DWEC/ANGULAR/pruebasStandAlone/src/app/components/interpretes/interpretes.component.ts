import { Component } from '@angular/core';
import { Interprete } from '../../models/interprete';
import { InterpretesService } from '../../services/interpretes.service';
import { DatePipe } from '@angular/common';
import { RouterLink } from '@angular/router';

@Component({
  selector: 'app-interpretes',
  imports: [DatePipe, RouterLink],
  templateUrl: './interpretes.component.html',
  styleUrl: './interpretes.component.css'
})
export class InterpretesComponent {
  public listInterpretes: Interprete[] = [];

  constructor(private serviceInterpretes: InterpretesService) {}

  ngOnInit() {
    console.log("Entra en ngOnInit");
    
    this.serviceInterpretes.listarInterpretes().subscribe(
      datos => {
        this.listInterpretes = datos;
        console.log("listInterpretes :>> ", this.listInterpretes);
        
      }, error => console.log("Error al obtener listInterpretes :>> ", error)
    )
  }

  borrarInterprete(interpreteBorrar: Interprete) {
    console.log("interpreteBorrar :>> ", interpreteBorrar);
    
    if(confirm("¿Deseas eliminar a '"+interpreteBorrar.nombre+" "+interpreteBorrar.apellidos+"'?")) {
      this.serviceInterpretes.borrarInterprete(interpreteBorrar.id).subscribe(
        datos => {
          this.listInterpretes = datos;
          console.log("listInterpretes después de borrar :>> ", datos);
        }, error => console.log("Error al borrar el intérprete :>> ", error)
      )
    }
  }
}
