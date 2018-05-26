import { Component, OnInit } from '@angular/core';
import { FormGroup, FormControl, FormBuilder, Validators } from '@angular/forms';
import { AuthService } from '../../services/auth.service';
import { Router } from '@angular/router';
import { AuthEventService } from '../../services/auth-event.service';
import { AuthTokenService } from '../../auth/auth-token.service';

@Component({
  selector: 'app-login',
  templateUrl: './login.component.html',
  styleUrls: ['./login.component.scss']
})
export class LoginComponent implements OnInit {

  loginForm: FormGroup;

  constructor(
    private fb: FormBuilder,
    private authService: AuthService,
    private tokenService: AuthTokenService,
    private router: Router,
    private authEventService: AuthEventService
  ) {
    this.createForm();
  }

  ngOnInit() {
  }

  createForm() {
    this.loginForm = this.fb.group({
      username: ['', Validators.required],
      password: ['', Validators.required]
    });
  }

  onSubmit(form) {
    
      const postData = {
        email: this.loginForm.get('username').value,
        password: this.loginForm.get('password').value
      }

      this.authService.login(postData).then(
        res => {
          console.log(res);
          if(res['success']) {
            this.tokenService.setToken(res['data']['access_token']);
            this.authEventService.changeAuthStatus(true);
            this.router.navigateByUrl('/dashboard');
          }else{
            alert(res);
          }
        }
      );
  }

}
