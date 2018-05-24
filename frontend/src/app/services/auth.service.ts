import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { config } from '../configs';

@Injectable()
export class AuthService {

  constructor(
    private http: HttpClient
  ) { }

  login(data) {
    return this.http.post(config.ApiBase + 'login', data)
        .toPromise().then(result => {
          return result;
        }, err => {
          return err.error;
        });
  }

  singup(data) {
    return this.http.post(config.ApiBase + 'signup', data)
      .toPromise().then(
        result => {
          return result;
        },err => {
          return err.error;
        }
      );
  }
}
