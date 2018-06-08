import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { config } from '../configs';
import { AuthTokenService } from '../auth/auth-token.service';

@Injectable()
export class AuthService {

  constructor(
    private http: HttpClient,
    private tokenService: AuthTokenService
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
        }, err => {
          return err.error;
        }
      );
  }
}
