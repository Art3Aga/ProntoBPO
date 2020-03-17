import { Injectable } from '@angular/core';

import * as crypto from 'crypto-js';
//var CryptoJS: CryptoJS.Hashes;


@Injectable({
  providedIn: 'root'
})
export class EncriptarService {


  //#region Atributos
  private secretKey: string = "2e35f242a46d67eeb74aabc37d5e5d05";
  //#endregion

  constructor() { }

  //#region Metodos

  Encriptar(valor: string): string {
    return crypto.AES.encrypt(valor, this.secretKey).toString();
  }
  DesEncriptar(valor: string): string {
    return crypto.AES.decrypt(valor, this.secretKey).toString(crypto.enc.Utf8);
  }

  //#endregion
}
