import { Component, OnInit } from '@angular/core';
import { AuthEventService } from '../../services/auth-event.service';
import { ValueTransformer } from '@angular/compiler/src/util';
import { FacebookService } from '../../services/FacebookService';

@Component({
  selector: 'app-dashboard',
  templateUrl: './dashboard.component.html',
  styleUrls: ['./dashboard.component.scss']
})
export class DashboardComponent implements OnInit {

  public loggedIn: boolean;

  constructor(
    private authEventService: AuthEventService,
    private facebookService: FacebookService
  ) { }

  ngOnInit() {
    this.authEventService.authStatus.subscribe(value => this.loggedIn = value);
    console.log('Dashboard loggedIn : ', this.loggedIn);
  }

  postText() {
    this.facebookService.postText()
      .then(res => {
        console.log(res);
      });
  }
  postVideo() {
    this.facebookService.postVideo()
      .then(res => {
        console.log(res);
      });
  }
  
}
