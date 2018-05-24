import { Injectable } from '@angular/core';
import { CanActivate, ActivatedRouteSnapshot, RouterStateSnapshot, Router } from '@angular/router';
import { Observable } from 'rxjs/Observable';
import { AuthTokenService } from '../services/auth-token.service';

@Injectable()
export class LoginGuardService implements CanActivate {

  constructor(
    private router: Router,
    private token: AuthTokenService
  ) { }

  canActivate(route: ActivatedRouteSnapshot, state: RouterStateSnapshot): boolean | Observable<boolean> | Promise<boolean> {
    if (this.token.loggedIn()) {
      return false;
    } else {
      return true;
    }
  }

}
