import { Component, OnInit } from '@angular/core';
import { ActivatedRoute, Router } from '@angular/router';
import { AuthFbService } from '../../services/auth-fb.service';
import { AuthTokenService } from '../../auth/auth-token.service';

@Component({
  selector: 'app-fb-login',
  templateUrl: './fb-login.component.html',
  styleUrls: ['./fb-login.component.scss']
})
export class FbLoginComponent implements OnInit {

  fbLoginUrl : string;

  constructor(
    private authFbService: AuthFbService,
    private route: ActivatedRoute,
    private tokenService: AuthTokenService,
    private router: Router
  ) { }

  ngOnInit() {
    this.getFbLoginUrl();
    this.stateChange();
  }

  stateChange() {
    this.route.queryParams.subscribe( params => {
      if(params.code) {
        this.getTokenFromCode(params.code);
      }
    });
      
  }

  getFbLoginUrl() {
    this.authFbService.getFbLoginUrl()
      .then( res => {
        console.log(res);
        if(res['status'] == true){
          this.fbLoginUrl = res['data']['login_url'];
        }
      })
  }

  getTokenFromCode(code) {
    this.authFbService.getTokenFromCode(code)
      .then( res => {
        
        if(res['token']) {
          this.tokenService.setToken(res['token']);
          this.router.navigate(['']);
        }
        
      })
  }

}
