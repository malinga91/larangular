import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';
import { LoginComponent } from './components/login/login.component';
import { SignupComponent } from './components/signup/signup.component';
import { FormsModule, ReactiveFormsModule, FormGroup } from '@angular/forms';
import { DashboardComponent } from './components/dashboard/dashboard.component';
import { AuthGuardService } from './auth/auth-guard.service';
import { LoginGuardService } from './auth/login-guard.service';


const appRoutes: Routes = [
  {
    path: 'login',
    component: LoginComponent,
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
