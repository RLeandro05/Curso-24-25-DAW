import { Component, EventEmitter, Input, Output } from '@angular/core';
import { Zona } from '../../../models/zona';
import { FormBuilder, FormGroup } from '@angular/forms';
import { ReactiveFormsModule } from '@angular/forms';

@Component({
  selector: 'app-zonas-form',
  imports: [ReactiveFormsModule],
  templateUrl: './zonas-form.component.html',
  styleUrl: './zonas-form.component.css'
})
export class ZonasFormComponent {
  @Input() zona: Zona = <Zona>{};
  @Output() zonaOutPut = new EventEmitter<Zona>();

  public form: FormGroup;

  constructor(private fb: FormBuilder) {
    this.form = fb.group({
      id: fb.control(-1),
      nombre: fb.control("")
    });
  }

  ngOnInit() {
    console.log("zona traída del padre :>> ", this.zona);

    if(this.zona.id != -1) {
      this.form = this.fb.group({
        id: this.fb.control(this.zona.id),
        nombre: this.fb.control(this.zona.nombre)
      });
    }
  }

  onSubmit() {
    this.zonaOutPut.emit(this.form.value);
  }
}
