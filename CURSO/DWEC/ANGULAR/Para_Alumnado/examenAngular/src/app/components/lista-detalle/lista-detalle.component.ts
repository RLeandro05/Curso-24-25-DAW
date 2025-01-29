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
  public detalleFacturaForm: DetallesFactura = <DetallesFactura>{};

  public totalesIVA: number = 0;
  public totalesTotal: number = 0;

  public textoBoton: string = "Añadir línea de detalle";

  //Constructor que muestra el listado de los detalles de la factura seleccionada
  constructor(private activatedRoute: ActivatedRoute, private peticion: PAjaxService) {
    this.idFactura = Number(this.activatedRoute.snapshot.params["id"]);
    this.numeroFactura = String(this.activatedRoute.snapshot.params["numero"]);

    this.peticion.listarDetallesFactura(this.idFactura).subscribe(datos => {
      console.log("Id de Factura :>> ", this.idFactura);
      console.log("Numero de Factura :>> ", this.numeroFactura);
      this.detallesFactura = datos;
      console.log("detallesFactura :>> ", this.detallesFactura);
      
      this.calcularIvasyTotales();
    });

    this.detalleFacturaForm = {
      id: -1,
      id_factura: 0,
      cantidad: 0,
      concepto: "",
      precio: 0,
      tipo_iva: 0,
      iva: 0,
      total: 0
    }
  }

  calcularIvasyTotales() {
    this.totalesIVA = 0;
    this.totalesTotal = 0;

    //Iteración de los detalles de la factura seleccionada
    for (let i = 0; i < this.detallesFactura.length; i++) {
      this.detalle = this.detallesFactura[i];

      //Por cada detalle, añadir en el campo iva y total sus valores
      this.detalle["iva"] = this.detalle["precio"]*(this.detalle["tipo_iva"]/100);
      this.totalesIVA += this.detalle["iva"];

      this.detalle["total"] = (this.detalle["iva"] + this.detalle["precio"])*this.detalle["cantidad"];
      this.totalesTotal += this.detalle["total"];
    }
  }

  public mostrarFormulario: boolean = false;

  toggleForm(accion: number, detalleTraido: DetallesFactura) {
    if (accion == 1 || accion == 0) {
      this.textoBoton = "Añadir línea de detalle";
      this.detalleFacturaForm = {
        id: -1,
        id_factura: 0,
        cantidad: 0,
        concepto: "",
        precio: 0,
        tipo_iva: 0,
        iva: 0,
        total: 0
      };
      //console.log("detalleFacturaForm :>> ", this.detalleFacturaForm);

      this.mostrarFormulario = !this.mostrarFormulario;

    } else {
      this.textoBoton = "Modificar línea de detalle";
      this.detalleFacturaForm = detalleTraido;
      //console.log("detalleFacturaForm :>> ", this.detalleFacturaForm);

      if (!this.mostrarFormulario) {
        this.mostrarFormulario = true;
      }
    }

    console.log(this.mostrarFormulario);
    
  }

  //Método para añadir un nuevo detalle el cual se lleva el objeto DetalleFactura al enviar el formulario
  onSubmit(detalleFacturaForm: DetallesFactura) {
    console.log("detalleFacturaForm :>> ", detalleFacturaForm);
    
    //console.log("idFactura :>> ", this.detalle["id_factura"]);

    detalleFacturaForm["id_factura"] = this.idFactura;

    if (detalleFacturaForm.id == -1) {
      this.peticion.nuevoDetalle(detalleFacturaForm).subscribe(datos => {
        this.detallesFactura = datos;
  
        this.calcularIvasyTotales();
      });
    } else {
      this.peticion.editarDetalle(detalleFacturaForm).subscribe(datos => {
        this.detallesFactura = datos;

        this.calcularIvasyTotales();
      })
    }
  }

  //Método para borrar un detalle específico
  onClickBorrar(idDetalle: number, concepto: string) {
    if (confirm("¿Estás seguro de que desea borrar '"+concepto+"'?")) {
      this.peticion.borrarDetalle(idDetalle, this.idFactura).subscribe(datos => {
        this.detallesFactura = datos;

        this.calcularIvasyTotales();
      })
    }
  }
}
