import { BrowserModule } from '@angular/platform-browser';
import { NgModule } from '@angular/core';


import { AppComponent } from './app.component';
import { ComponentsModule } from './components/components.module';
import { RoutingModule } from './routing.module';
import { FormsModule, ReactiveFormsModule } from '@angular/forms';
import { AuthService } from './services/auth.service';
import { AuthEventService } from './services/auth-event.service';
import { AfterLoginService } from './services/after-login.service';
import { BeforeLoginService } from './services/before-login.service';
import { AuthGuardService } from './auth/auth-guard.service';
import { LoginGuardService } from './auth/login-guard.service';
import { AuthTokenService } from './auth/auth-token.service';


@NgModule({
  declarations: [
    AppComponent
  ],
  imports: [
    BrowserModule,
    ComponentsModule,
    RoutingModule,
  ],
  providers: [AuthService, AuthTokenService, AuthEventService, BeforeLoginService, AfterLoginService, AuthGuardService, LoginGuardService],
  bootstrap: [AppComponent]
})
export class AppModule { }
