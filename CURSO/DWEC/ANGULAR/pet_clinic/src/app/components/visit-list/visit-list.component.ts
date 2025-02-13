import { Component, EventEmitter, Input, Output } from '@angular/core';
import { Visit } from '../../modules/visit';
import { VisitService } from '../../services/visit.service';

@Component({
  selector: 'app-visit-list',
  imports: [],
  templateUrl: './visit-list.component.html',
  styleUrl: './visit-list.component.css'
})
export class VisitListComponent {
  @Input() visits: Visit[] = [];
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
}
