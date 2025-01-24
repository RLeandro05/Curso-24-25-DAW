import { Component } from '@angular/core';
import { Persona } from '../../modelos/persona';
import { Router, ActivatedRoute } from '@angular/router';
import { PAjaxService } from '../../servicios/p-ajax.service';

@Component({
  selector: 'app-form-persona',
  standalone: false,
  
  templateUrl: './form-persona.component.html',
  styleUrl: './form-persona.component.css'
})
export class FormPersonaComponent {
  //public persona: Persona;
  public persona: Persona = <Persona>{};
  public textoBoton: string;
  public listaPer: Persona[] = [];
  constructor(private peticion:PAjaxService, private ruta: Router) {
    this.persona = {
      ID: -1,
      DNI: "",
      NOMBRE: "",
      APELLIDOS: ""
    }
    this.textoBoton = "Añadir";
  }

  onSubmit(personaForm: Persona) {
    //console.log("personaForm:> ", personaForm);
    //console.log("personaForm.DNI:> ", personaForm.DNI);
    
    //Realizar consulta a servicio.php y sacar los datos una vez realizada
    this.peticion.aniadirPersona(personaForm).subscribe(datos => {
      console.log("Estamos en aniadirPersona", datos);
      this.listaPer = datos;
    })

    //Avisar que la persona ha sido añadida correctamente
    alert("Persona' "+personaForm.NOMBRE+" "+personaForm.APELLIDOS+"' añadida a la base de datos correctamente.");

    //Redirigir a el listado de personas
    this.ruta.navigate(["/"]);
  }
}
