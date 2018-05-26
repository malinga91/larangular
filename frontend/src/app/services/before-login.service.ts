import { Injectable } from '@angular/core';
import { CanActivate, ActivatedRouteSnapshot, RouterStateSnapshot, Router } from '@angular/router';
import { Observable } from 'rxjs/Observable';
import { AuthTokenService } from '../auth/auth-token.service';

@Injectable()
export class BeforeLoginService implements CanActivate{

  canActivate(route: ActivatedRouteSnapshot, state: RouterStateSnapshot): boolean | Observable<boolean> | Promise<boolean> {
    return !this.tokenService.loggedIn();

    
  }
  constructor(
    private tokenService: AuthTokenService,
    private router: Router
  ) { }

}
