import { Component, Input } from '@angular/core';
import { Visit } from '../../modules/visit';

@Component({
  selector: 'app-visit-list',
  imports: [],
  templateUrl: './visit-list.component.html',
  styleUrl: './visit-list.component.css'
})
export class VisitListComponent {
  @Input() visits: Visit[] = [];

  constructor() {}
}
