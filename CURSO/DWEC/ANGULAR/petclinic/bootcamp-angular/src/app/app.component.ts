import { Component } from '@angular/core';
import { RouterOutlet, RouterLink } from '@angular/router';
import { SearchComponent } from './search/search.component';

@Component({
  selector: 'app-root',
  imports: [RouterOutlet, SearchComponent, RouterLink],
  templateUrl: './app.component.html',
  styleUrl: './app.component.css'
})
export class AppComponent {
  title = 'bootcamp_ejemplo';

  msgEventSearch: string = '';

  search(event: any){
    this.msgEventSearch = `Query: ${event.query}, Resultado: ${event.resultado}`;
  }
}
