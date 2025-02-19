import { Component } from '@angular/core';
import { FormBuilder, FormGroup, Validators, ReactiveFormsModule } from '@angular/forms';
import { ActivatedRoute, Router, RouterLink } from '@angular/router';
import { InterpretesService } from '../../services/interpretes.service';

@Component({
  selector: 'app-interprete-form',
  imports: [ReactiveFormsModule, RouterLink],
  templateUrl: './interprete-form.component.html',
  styleUrl: './interprete-form.component.css'
})
export class InterpreteFormComponent {
  public form: FormGroup;
  public textButton: string = "";
  public idInterpreteRoute: number = 0;

  constructor(private fb: FormBuilder, private activatedRoute: ActivatedRoute, private serviceInterprete: InterpretesService, private route: Router) {
    this.form = fb.group({
      id: fb.control("-1"),
      nombre: fb.control('', [Validators.required]),
      apellidos: fb.control('', [Validators.required]),
      fecha_nacimiento: fb.control(null, [Validators.required]),
      biografia: fb.control('', [Validators.required])
    });
  }

  ngOnInit() {
    this.idInterpreteRoute = Number(this.activatedRoute.snapshot.params["idInterprete"]);
    console.log("idInterpreteRoute :>> ", this.idInterpreteRoute);
    
    if(this.idInterpreteRoute === -1) {
      this.textButton = "Añadir";
    } else {
      this.textButton = "Modificar";

      this.serviceInterprete.obtenerInterpreteId(this.idInterpreteRoute).subscribe(
        datos => {
          this.form = this.fb.group({
            id: this.fb.control(datos.id),
            nombre: this.fb.control(datos.nombre, [Validators.required]),
            apellidos: this.fb.control(datos.apellidos, [Validators.required]),
            fecha_nacimiento: this.fb.control(datos.fecha_nacimiento, [Validators.required]),
            biografia: this.fb.control(datos.biografia, [Validators.required])
          });
        }
      )
    }
  }

  onSubmit() {
    let interpreteForm = this.form.value;
    console.log("interpreteForm :>> ", interpreteForm);

    if(this.idInterpreteRoute === -1) {
      this.serviceInterprete.anadeInterprete(interpreteForm).subscribe();
    } else {
      this.serviceInterprete.modificaInterprete(interpreteForm).subscribe();
    }

    this.route.navigate(['/interpretes']);
    
  }
}
