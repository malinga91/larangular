import { Component, OnInit } from '@angular/core';
import { AuthEventService } from '../../services/auth-event.service';
import { AuthTokenService } from '../../services/auth-token.service';
import { Router } from '@angular/router';

@Component({
  selector: 'app-nav-bar',
  templateUrl: './nav-bar.component.html',
  styleUrls: ['./nav-bar.component.scss']
})
export class NavBarComponent implements OnInit {

  public loggedIn: boolean;

  constructor(
    private authEventService: AuthEventService,
    private tokenService: AuthTokenService,
    private router: Router
  ) { }

  ngOnInit() {

    this.authEventService.authStatus.subscribe(value => this.loggedIn = value);
    console.log('NavBar loggedIn : ', this.loggedIn);

  }

  logout(event: MouseEvent) {
    event.preventDefault();

    this.authEventService.changeAuthStatus(false);
    this.tokenService.removeToken();
    this.router.navigateByUrl('/login');

  }

}
