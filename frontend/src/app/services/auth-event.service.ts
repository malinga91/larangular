import { Injectable } from '@angular/core';
import { BehaviorSubject } from 'rxjs/BehaviorSubject';

@Injectable()
export class AuthEventService {

  private loggedIn = new BehaviorSubject<boolean>(false)

  authStatus = this.loggedIn.asObservable();

  changeAuthStatus(value: boolean) {
    this.loggedIn.next(value);
  }

  constructor() { }

}
