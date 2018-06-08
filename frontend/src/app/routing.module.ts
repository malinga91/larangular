import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';
import { SignupComponent } from './components/signup/signup.component';
import { FormsModule, ReactiveFormsModule, FormGroup } from '@angular/forms';
import { DashboardComponent } from './components/dashboard/dashboard.component';
import { AuthGuardService } from './auth/auth-guard.service';
import { LoginGuardService } from './auth/login-guard.service';
import { FbLoginComponent } from './components/fb-login/fb-login.component';


const appRoutes: Routes = [
  {
    path: 'login',
    component: FbLoginComponent,
    canActivate: [LoginGuardService]
    
  },
  {
    path: 'signup',
    component: SignupComponent,
    canActivate: [LoginGuardService]
  },
  {
    path: 'dashboard',
    component: DashboardComponent,
    canActivate: [AuthGuardService]
  },
  {
    path: '',
    redirectTo: 'dashboard',
    pathMatch: 'full'
  },
  {
    path: '**',
    redirectTo: './404',
  },
  {
    path: '404',
    component: DashboardComponent
  }
]

@NgModule({
  imports: [
    RouterModule.forRoot(appRoutes),
  ],
  declarations: [],
  exports: [RouterModule],
})
export class RoutingModule { }
