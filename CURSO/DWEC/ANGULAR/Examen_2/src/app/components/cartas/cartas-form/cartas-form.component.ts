import { Component } from '@angular/core';
import { ActivatedRoute, Router } from '@angular/router';
import { CartasService } from '../../../services/cartas.service';
import { FormBuilder, FormGroup, Validators } from '@angular/forms';
import { ReactiveFormsModule } from '@angular/forms';
import { RouterLink } from '@angular/router';
import { Carta } from '../../../models/carta';
import { LocalesService } from '../../../services/locales.service';

@Component({
  selector: 'app-cartas-form',
  imports: [ReactiveFormsModule, RouterLink],
  templateUrl: './cartas-form.component.html',
  styleUrl: './cartas-form.component.css'
})
export class CartasFormComponent {
  public idLocalRoute: number = 0;
  public idLineaCarta: number = 0;
  public form: FormGroup;
  public textButton: string = "Añadir a la carta";
  public carta: Carta = <Carta>{};

  constructor(private route: Router, private activatedRoute: ActivatedRoute, private serviceCartas: CartasService, private fb: FormBuilder) {
    this.form = fb.group({
      id: fb.control("-1"),
      descripcion: fb.control(""),
      tipo: fb.control(""),
      precio: fb.control("")
    })
  }

  ngOnInit() {
    this.idLocalRoute = Number(this.activatedRoute.snapshot.params['idLocal']);
    this.idLineaCarta = Number(this.activatedRoute.snapshot.params['idLineaCarta']);

    console.log("idLocalRoute :>> ", this.idLocalRoute);
    console.log("idLineaCarta :>> ", this.idLineaCarta);

    if(this.idLineaCarta != -1) {
      this.serviceCartas.obtenerLiniaCartaId(this.idLineaCarta).subscribe(
        datos => {
          console.log("lineaCarta obtenida :>> ", datos);
          
          this.form = this.fb.group({
            id: this.fb.control(datos.id),
            descripcion: this.fb.control(datos.descripcion),
            tipo: this.fb.control(datos.tipo),
            precio: this.fb.control(datos.precio)
          })
        }, error => console.error("Error el obtener la línea de la carta :>> ", error)
      )
    }
    
  }

  onSubmit() {
    this.carta = this.form.value;
    this.carta.id_local = this.idLocalRoute;

    if(this.carta.id == -1) {
      
      console.log("carta nueva :>> ", this.carta);
      
      this.serviceCartas.anadeCarta(this.carta).subscribe(
        datos => {
          console.log("Resultado :>> ", datos);
          
          this.route.navigate(['/locales-detail', this.idLocalRoute]);
        }, error => console.error("Error al añadir nueva línea a la carta :>> ", error)
      )
    } else {

      console.log("carta a editar :>> ", this.carta);

      this.serviceCartas.modificaLiniaCarta(this.carta).subscribe(
        datos => {
          console.log("Resultado :>> ", datos);
          
          this.route.navigate(['/locales-detail', this.idLocalRoute]);
        }, error => console.error("Error al modificar la línea d ela carta específica :>> ", error)
      )
    }
    
    
  }
}
