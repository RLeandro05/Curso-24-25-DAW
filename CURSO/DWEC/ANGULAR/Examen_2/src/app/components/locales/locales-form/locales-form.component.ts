import { Component } from '@angular/core';
import { FormBuilder, FormGroup, Validators } from '@angular/forms';
import { ActivatedRoute, Router } from '@angular/router';
import { ReactiveFormsModule } from '@angular/forms';
import { RouterLink } from '@angular/router';
import { ZonasService } from '../../../services/zonas.service';
import { Zona } from '../../../models/zona';
import { Local } from '../../../models/local';
import { LocalesService } from '../../../services/locales.service';

@Component({
  selector: 'app-locales-form',
  imports: [ReactiveFormsModule, RouterLink],
  templateUrl: './locales-form.component.html',
  styleUrl: './locales-form.component.css'
})
export class LocalesFormComponent {
  public idLocalRoute: number = 0;
  public form: FormGroup;
  public textButton: string = "Añadir";
  public listZonas: Zona[] = [];
  public local: Local = <Local>{};

  constructor(private serviceLocales: LocalesService, private serviceZonas: ZonasService, private activatedRoute: ActivatedRoute, private route: Router, private fb: FormBuilder) {
    this.form = fb.group({
      id: fb.control("-1"),
      nombre: fb.control(""),
      id_zona: fb.control(""),
      telefono: fb.control(""),
      direccion: fb.control(""),
      observaciones: fb.control(""),
    })
  }

  ngOnInit() {
    this.idLocalRoute = Number(this.activatedRoute.snapshot.params['idLocal']);
    console.log("idLocalRoute :>> ", this.idLocalRoute);

    this.serviceZonas.listarZonas().subscribe(
      datos => {
        this.listZonas = datos;
        console.log("listZonas :>> ", this.listZonas);

        if(this.idLocalRoute != -1) {
          this.serviceLocales.obtenerLocalId(this.idLocalRoute).subscribe(
            datos => {
              this.local = datos;
              console.log("local obtenido a editar :>> ", this.local);
              
              this.form = this.fb.group({
                id: this.fb.control(this.local.id),
                nombre: this.fb.control(this.local.nombre),
                id_zona: this.fb.control(this.local.id_zona),
                telefono: this.fb.control(this.local.telefono),
                direccion: this.fb.control(this.local.direccion),
                observaciones: this.fb.control(this.local.observaciones),
              })
            }, error => console.error("Error al obtener el local a editar :>> ", error)
          )
        }
      }, error => console.error("Error al obtener listZonas :>> ", error)
    )
    
    //console.log("form vacío :>> ", this.form.value);
  }

  irAListaroDetail() {
    if(this.idLocalRoute === -1) {
      this.route.navigate(['/']);
    } else {
      this.route.navigate(['/locales-detail', this.idLocalRoute]);
    }
  }

  onSubmit() {
    console.log("form nuevo :>> ", this.form.value);
    
    this.local = this.form.value;

    if(this.idLocalRoute === -1) {
      this.serviceLocales.anadeLocal(this.local).subscribe(
        datos => {
          console.log("Resultado :>> ", datos);
          
          this.route.navigate(['/'])
        }, error => console.error("Error al añadir un nuevo local :>> ", error)
      )
    } else {
      this.serviceLocales.modificaLocal(this.local).subscribe(
        datos => {
          console.log("Resultado :>> ", datos);
          
          this.route.navigate(['/locales-detail', this.idLocalRoute]);
        }, error => console.error("Error al modificar el local :>> ", error)
      )
    }
    
  }
}
