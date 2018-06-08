import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { config } from '../configs';

@Injectable()
export class AuthFbService {

  constructor(
    private http: HttpClient
  ) { }

  getFbLoginUrl() {
    return this.http.get(config.ApiBase + 'facebook/login')
      .toPromise().then(
        res => {
          return res;
        }
      );
  }

  getTokenFromCode(code) {
    return this.http.post(config.ApiBase + 'facebook/get_token', {
      "code" : code
    })
      .toPromise().then(
        res => {
          console.log(res);
          return res;
        }
      )
  }

}
