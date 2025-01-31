import { Component } from '@angular/core';
import { DetallesFactura } from '../../modules/detalles-factura';
import { ActivatedRoute } from '@angular/router';
import { ListaDetalleService } from '../../services/lista-detalle.service';
import { RouterLink } from '@angular/router';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';

@Component({
  selector: 'app-lista-detalle',
  imports: [RouterLink, CommonModule, FormsModule],
  templateUrl: './lista-detalle.component.html',
  styleUrl: './lista-detalle.component.css'
})
export class ListaDetalleComponent {
  //Lista de detalles para mostrar por pantalla después de cada petición de mostrar
  public detallesFactura: DetallesFactura[] = [];

  //Variables donde se guarda del routerLink el id de factura y el número de la factura
  public idFactura: number = 0;
  public numeroFactura: string = "";

  //Variables donde se van calculando el IVA y el total de los detalles de la factura
  public IVA: number = 0;
  public Total: number = 0;

  //Objeto usado para iterar en los for de la lista de detalles
  public detalle: DetallesFactura = <DetallesFactura>{};
  //Objeto para poder inicializar por defecto en el formulario
  public detalleFacturaForm: DetallesFactura = <DetallesFactura>{};

  //Variables para calcular totales de IVA y de total
  public totalesIVA: number = 0;
  public totalesTotal: number = 0;

  //Variable para ir alternando el texto del botón dependiendo de si se quiere añadir o editar
  public textoBoton: string = "Añadir línea de detalle";

  //Constructor que muestra el listado de los detalles de la factura seleccionada
  constructor(private activatedRoute: ActivatedRoute, private peticion: ListaDetalleService) {
    //Se trae del routerLink id_factura y numero_factura
    this.idFactura = Number(this.activatedRoute.snapshot.params["id"]);
    this.numeroFactura = String(this.activatedRoute.snapshot.params["numero"]);

    //Petición para listar los detalles de la factura seleccionada
    this.peticion.listarDetallesFactura(this.idFactura).subscribe(datos => {
      console.log("Id de Factura :>> ", this.idFactura);
      console.log("Numero de Factura :>> ", this.numeroFactura);
      this.detallesFactura = datos;
      console.log("detallesFactura :>> ", this.detallesFactura);
      
      //Calcular ivas y totales
      this.calcularIvasyTotales();
    });

    //Inicializar el objeto vacío para el formulario
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

  //Método para calcular los ivas y totales cada vez se actualiza la tabla de los detalles
  calcularIvasyTotales() {
    this.totalesIVA = 0;
    this.totalesTotal = 0;

    //Iteración de los detalles de la factura seleccionada
    for (let i = 0; i < this.detallesFactura.length; i++) {
      this.detalle = this.detallesFactura[i];

      //Por cada detalle, añadir en el campo iva y total sus valores
      this.detalle["iva"] = (this.detalle["cantidad"]*this.detalle["precio"])*(this.detalle["tipo_iva"]/100);
      this.totalesIVA += this.detalle["iva"];

      this.detalle["total"] = (this.detalle["cantidad"]*this.detalle["precio"])+this.detalle["iva"];
      this.totalesTotal += this.detalle["total"];
    }
  }

  //Variable booleana para alternar la visualización del formulario
  public mostrarFormulario: boolean = false;

  //Método que, según qué acción se realice, mostrar o esconder el formulario, y actualizar el objeto vacío
  toggleForm(accion: number, detalleTraido: DetallesFactura) {
    //Si se decide añadir o terminar el añadido o modificación, cambiar el texto del botón y volver a vaciar el objeto
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

      if (this.mostrarFormulario == true) {
        console.log("detalleFacturaForm :>> ", this.detalleFacturaForm);
      }

      this.mostrarFormulario = !this.mostrarFormulario;

      console.log("mostrarFormulario :>> ", this.mostrarFormulario);

    } else { //Si se decide modificar, cambiar el texto del botón y actualizar el objeto vacío con los datos traídos del HTML
      this.textoBoton = "Modificar línea de detalle";
      this.detalleFacturaForm = detalleTraido;

      if (!this.mostrarFormulario) {
        this.mostrarFormulario = true;
        console.log("detalleFacturaForm :>> ", this.detalleFacturaForm);
      }

      console.log("mostrarFormulario :>> ", this.mostrarFormulario);
    }
    
  }

  //Método para añadir un nuevo detalle el cual se lleva el objeto DetalleFactura al enviar el formulario
  onSubmit(detalleFacturaForm: DetallesFactura) {
    //console.log("detalleFacturaForm :>> ", detalleFacturaForm);
    
    //console.log("idFactura :>> ", this.detalle["id_factura"]);

    //Guardar en un nuevo campo el id_factura para poder realizar las peticiones
    detalleFacturaForm["id_factura"] = this.idFactura;

    //Si el id de el detalle traído es '-1', es decir, que es un objeto vacío, estamos añadiendo un objeto, por lo que entrará aquí
    if (detalleFacturaForm.id == -1) {
      this.peticion.nuevoDetalle(detalleFacturaForm).subscribe(datos => {
        this.detallesFactura = datos;
  
        //Calcular los nuevos ivas y totales
        this.calcularIvasyTotales();
      });
    } else { //Si el id no es -1, significa que ha traído un objeto ya existente y modificado, por lo que entrará aquí para ser modificado
      this.peticion.editarDetalle(detalleFacturaForm).subscribe(datos => {
        this.detallesFactura = datos;

        //Calcular los nuevos ivas y totales
        this.calcularIvasyTotales();
      })
    }
  }

  //Método para borrar un detalle específico
  onClickBorrar(idDetalle: number, concepto: string) {
    //Mandar aviso de borrado por si se arrepiente
    if (confirm("¿Estás seguro de que deseas borrar '"+concepto+"'?")) {
      this.peticion.borrarDetalle(idDetalle, this.idFactura).subscribe(datos => {
        this.detallesFactura = datos;

        //Calcular los nuevos ivas y totales
        this.calcularIvasyTotales();
      })
    }
  }
}
