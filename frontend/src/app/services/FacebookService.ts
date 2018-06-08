import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { config } from '../configs';
import { AuthTokenService } from '../auth/auth-token.service';

@Injectable()
export class FacebookService {

  constructor(
    private http: HttpClient,
    private token: AuthTokenService
  ) {    
  }

  postText() {
    return this.http.post(config.ApiBase + 'facebook/text?token='+ this.token.getToken(), {})
      .toPromise().then(res => {
        console.log(res);
      }, err => {
        console.log('Error ', err.error);
      })
  }
  postVideo() {
    return this.http.post(config.ApiBase + 'facebook/video?token='+ this.token.getToken(), '')
      .toPromise().then(res => {
        return res;
      }, err => {
        return err.error;
      })
  }



}
