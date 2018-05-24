import { Injectable } from '@angular/core';

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
    console.log('getToken :', token);
    if(token) {
      return true;
    }else{
      return false;
    }
  }

  loggedIn() {
    console.log('LoggedIn auth token : ', this.isValid());
    return this.isValid();
  }

}
