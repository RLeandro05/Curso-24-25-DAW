import { Component } from '@angular/core';
import * as CryptoJS from "crypto-js";

@Component({
  selector: 'app-login',
  imports: [],
  templateUrl: './login.component.html',
  styleUrl: './login.component.css'
})
export class LoginComponent {
  constructor() {}

  validar(log: any) {
    console.log(log);
    
    const claveHash = CryptoJS.SHA3(log.clave).toString(CryptoJS.enc.Base64);
    console.log("hashClave = ", claveHash);
    log.clave = claveHash;
    console.log("log: ", log);

    this.servicioLogin.getLogin_perfil(log).subscribe(
      res => {
        console.log(res);
        
      }
    )
  }
}
