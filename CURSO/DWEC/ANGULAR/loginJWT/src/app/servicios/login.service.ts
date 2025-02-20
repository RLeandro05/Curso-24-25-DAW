import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { environment } from '../../environments/environment.development';

@Injectable({
  providedIn: 'root'
})
export class LoginService {
  private url: string = environment.API_URL;

  constructor(private http:HttpClient) { }

  getLogin_perfil() {
    
  }
}
