import { Component } from '@angular/core';
import { ActivatedRoute, Router, RouterLink } from '@angular/router';
import { PAjaxService } from '../../servicios/p-ajax.service';
import { Persona } from '../../modelos/persona';
import { FormBuilder, FormGroup, ReactiveFormsModule, Validators } from "@angular/forms";

@Component({
  selector: 'app-form-personas',
  imports: [RouterLink, ReactiveFormsModule],
  templateUrl: './form-personas.component.html',
  styleUrl: './form-personas.component.css'
})
export class FormPersonasComponent {
  //public persona: Persona;
  public persona: Persona = <Persona>{};
  public textoBoton: string;
  public listaPer: Persona[] = [];
  public personaID: number = 0;

  public form: FormGroup;
  
  constructor(private peticion:PAjaxService, 
    private ruta: Router, 
    private route: ActivatedRoute, 
    private fb: FormBuilder) {



    this.form = this.fb.group({
      id: fb.control('-1'),
      dni: fb.control('', [Validators.required, Validators.minLength(9)]),
      nombre: fb.control('', [Validators.required]),
      apellidos: fb.control('', [Validators.required])
    });
    this.textoBoton = "Añadir";
  }

  ngOnInit() {
    //Acceder al valor del id
    this.personaID = Number(this.route.snapshot.params["id"]);
    console.log("personaID: ", this.personaID);

    if (this.personaID === -1) { //Si es -1 el id, dejar el texto del botón en Añadir
      this.textoBoton = "Añadir";
      console.log("Se mete en Añadir");
      
    } else { //Si tiene un id válido, se cambiará a modificar
      this.textoBoton = "Modificar";
      console.log("Se mete en Modificar");
      

      this.peticion.selPersonaID(this.personaID).subscribe(
        personaSel => { //Sacar un parámetro donde se guardará el objeto persona recibido de la consulta
          console.log("persona :>", personaSel);
  
          //Guardar la personaSel en la variable this.persona anteriormente creada
          this.persona = personaSel;
          this.form.patchValue(this.persona);
        }
      );
    }
    
  }

  onSubmit() {
    let personaForm = this.form.value;
    //console.log("personaForm:> ", personaForm);
    //console.log("personaForm.DNI:> ", personaForm.DNI);
    
    /*this.peticion.aniadirPersona(personaForm).subscribe(datos => {
      console.log("Estamos en aniadirPersona", datos);
      this.listaPer = datos;
    })*/

      if (this.personaID == -1) {
        //Realizar consulta a servicio.php y sacar los datos una vez realizada
        this.peticion.aniadirPersona(personaForm).subscribe();

        //Avisar que la persona ha sido añadida correctamente
        alert("Persona' "+personaForm.nombre+" "+personaForm.apellidos+"' añadida a la base de datos correctamente.");

        //Redirigir a el listado de personas
        this.ruta.navigate(["/"]); 
      } else {
        personaForm.id = this.personaID;

        this.peticion.modificarPersona(personaForm).subscribe();

        console.log("personaForm :> ", personaForm);
        

        alert("Persona' "+personaForm.nombre+" "+personaForm.apellidos+"' modificada correctamente.");

        this.ruta.navigate(["/"]);
      }
  }
}
