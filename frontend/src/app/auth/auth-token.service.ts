import { Injectable } from '@angular/core';
import * as jwt_decode from 'jwt-decode';

@Injectable()
export class AuthTokenService {

  constructor() { }

  setToken(token) {
    localStorage.setItem('access_token', token);
  }

  getToken() {
    return localStorage.getItem('access_token');
  }

  removeToken() {
    localStorage.removeItem('access_token');
  }

  isValid() {
    const token = this.getToken();

    if(token) {
      return true;
    }else{
      return false;
    }
  }

  decodeToken(token) {
    return jwt_decode(token);
  }

  loggedIn() {
    return this.isValid();
  }

}
