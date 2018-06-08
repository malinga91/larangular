import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { NavBarComponent } from './nav-bar/nav-bar.component';
import { LoginComponent } from './login/login.component';
import { SignupComponent } from './signup/signup.component';
import { ReactiveFormsModule, FormsModule } from '@angular/forms';
import { HttpClientModule } from '@angular/common/http';
import { RouterModule } from '@angular/router';
import { DashboardComponent } from './dashboard/dashboard.component';
import { FbLoginComponent } from './fb-login/fb-login.component';
import { FacebookService } from '../services/FacebookService';

@NgModule({
  imports: [
    CommonModule,
    FormsModule,
    ReactiveFormsModule,
    HttpClientModule,
    RouterModule
  ],
  declarations: [NavBarComponent, LoginComponent, SignupComponent, DashboardComponent, FbLoginComponent],
  exports: [NavBarComponent],
  providers: [FacebookService]
})
export class ComponentsModule { }
