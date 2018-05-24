import { Component, OnInit } from '@angular/core';
import { Validators, FormBuilder, FormGroup } from '@angular/forms';
import { HttpClient } from '@angular/common/http';

@Component({
  selector: 'app-signup',
  templateUrl: './signup.component.html',
  styleUrls: ['./signup.component.scss']
})
export class SignupComponent implements OnInit {

  signUpForm: FormGroup;

  constructor(
    private fb: FormBuilder,
    private http: HttpClient
  ) {
    this.createForm();
  }

  ngOnInit() {
  }

  createForm() {
    this.signUpForm = this.fb.group({
      name: ['', Validators.required],
      username: ['', Validators.required],
      password: ['', Validators.required],
      password_confirmation: ['', Validators.required]
    });
  }

  onSubmit(form) {
    console.log(form.valid);

    const postData = {
      name: this.signUpForm.get('name').value,
      email: this.signUpForm.get('username').value,
      password: this.signUpForm.get('password').value,
      password_confirmation: this.signUpForm.get('password_confirmation').value
    }
    console.log(postData);

    return this.http.post('http://localhost/LaravelAngular/backend/public/api/signup', postData)
      .subscribe(result => {
        console.log(result);
      }, err => {
        console.log(err);
      });


  }

}
