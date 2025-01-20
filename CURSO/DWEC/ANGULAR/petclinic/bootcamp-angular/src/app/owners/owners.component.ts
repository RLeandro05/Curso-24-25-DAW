import { Component, OnInit } from '@angular/core';
import { PAjaxService } from '../p-ajax.service';

@Component({
  selector: 'app-owners',
  imports: [],
  templateUrl: './owners.component.html',
  styleUrl: './owners.component.css'
})
export class OwnersComponent {
  constructor(private servicioPAjax: PAjaxService) {}

  ngOnInit() {
    this.servicioPAjax.getOwners().subscribe({
      next: res => {
        console.log("res >> ", res);
        
      },
      error: error => console.log("Error: ", error)
      
    });
  }
}
