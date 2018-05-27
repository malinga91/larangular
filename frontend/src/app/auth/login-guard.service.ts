import { Injectable } from '@angular/core';
import { CanActivate, ActivatedRouteSnapshot, RouterStateSnapshot, Router } from '@angular/router';
import { Observable } from 'rxjs/Observable';
import { AuthTokenService } from './auth-token.service';
import { AuthService } from '../services/auth.service';

@Injectable()
export class LoginGuardService implements CanActivate {

  constructor(
    private router: Router,
    private token: AuthTokenService,
    private authService: AuthService
  ) { }

  canActivate(route: ActivatedRouteSnapshot, state: RouterStateSnapshot): boolean | Observable<boolean> | Promise<boolean> {
    if (this.token.loggedIn()) {
      return false;
    } else {
      this.authService.getLoginUrl().then(res => console.log(res));

      return true;
    }
  }

}
