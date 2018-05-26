import { Injectable } from '@angular/core';
import { BehaviorSubject } from 'rxjs/BehaviorSubject';
import { AuthTokenService } from '../auth/auth-token.service';

@Injectable()
export class AuthEventService {

  private loggedIn = new BehaviorSubject<boolean>(this.tokenService.isValid());

  authStatus = this.loggedIn.asObservable();

  changeAuthStatus(value: boolean) {
    this.loggedIn.next(value);
  }

  constructor(
    private tokenService: AuthTokenService
  ) { }

}
