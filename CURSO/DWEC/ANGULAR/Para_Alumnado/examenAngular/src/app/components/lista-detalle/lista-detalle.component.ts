import { Component } from '@angular/core';
import { ActivatedRoute } from '@angular/router';
import { PAjaxService } from '../../services/pajax.service';
import { DetallesFactura } from '../../modules/detalles-factura';

@Component({
  selector: 'app-lista-detalle',
  standalone: false,
  
  templateUrl: './lista-detalle.component.html',
  styleUrl: './lista-detalle.component.css'
})
export class ListaDetalleComponent {
  public detallesFactura: DetallesFactura[] = [];
  public idFactura: number = 0;
  public numeroFactura: string = "";
  public IVA: number = 0;
  public Total: number = 0;
  public detalle: DetallesFactura = <DetallesFactura>{};
  public totalesIVA: number = 0;
  public totalesTotal: number = 0;

  //Constructor que muestra el listado de los detalles de la factura seleccionada
  constructor(private activatedRoute: ActivatedRoute, private peticion: PAjaxService) {
    this.idFactura = Number(this.activatedRoute.snapshot.params["id"]);
    this.numeroFactura = String(this.activatedRoute.snapshot.params["numero"]);

    this.peticion.listarDetallesFactura(this.idFactura).subscribe(datos => {
      console.log("Id de Factura :>> ", this.idFactura);
      console.log("Numero de Factura :>> ", this.numeroFactura);
      this.detallesFactura = datos;
      console.log("detallesFactura :>> ", this.detallesFactura);

      //Iteración de los detalles de la factura seleccionada
      for (let i = 0; i < this.detallesFactura.length; i++) {
        this.detalle = this.detallesFactura[i];

        //Por cada detalle, añadir en el campo iva y total sus valores
        this.detalle["iva"] = parseFloat((this.detalle["precio"]*(this.detalle["tipo_iva"]/100)).toFixed(2));
        this.totalesIVA += this.detalle["iva"];

        this.detalle["total"] = parseFloat(this.detalle["iva"] + this.detalle["precio"].toFixed(2));
        this.totalesTotal += this.detalle["total"];
      }
      

    });
  }

  public mostrarFormulario: boolean = false;

  toggleForm() {
    this.mostrarFormulario = !this.mostrarFormulario;
  }

  onSubmit(detalleFacturaForm: DetallesFactura) {
    console.log("detalleFacturaForm :>> ", detalleFacturaForm);
    
    detalleFacturaForm["id_factura"] = this.idFactura;

    this.peticion.nuevoDetalle(detalleFacturaForm).subscribe(datos => {
      this.detallesFactura = datos;
    })
  }
}
