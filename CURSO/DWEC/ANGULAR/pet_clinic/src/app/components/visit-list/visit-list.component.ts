import { Component, EventEmitter, Input, Output } from '@angular/core';
import { Visit } from '../../modules/visit';
import { VisitService } from '../../services/visit.service';
import { RouterLink } from '@angular/router';

@Component({
  selector: 'app-visit-list',
  imports: [RouterLink],
  templateUrl: './visit-list.component.html',
  styleUrl: './visit-list.component.css'
})
export class VisitListComponent {
  @Input() visits: Visit[] = [];
  @Input() idOwner: number = 0;
  @Input() idPet: number = 0;
  @Output() visitDeleted = new EventEmitter<number>();

  constructor(private servicioVisit: VisitService) {}

  borrarVisita(idVisit: number) {
    if(confirm("¿Quieres eliminar la visit?")) {
      this.servicioVisit.borrarVisit(idVisit).subscribe(
        datos => {
          console.log("print :>> ", datos);
          
          this.visitDeleted.emit(idVisit);
        },
        error => console.log("Error :>> ", error)
        
      );
    }
  }

  ngOnInit() {
    console.log("idOwner en visit-list :>> ", this.idOwner);
    console.log("idPet en visit-list :>> ", this.idPet);
  }
}
