import { Component, OnInit } from '@angular/core';
import { FormBuilder, FormGroup, Validators } from '@angular/forms';
import { ActivatedRoute, Router } from '@angular/router';
import { AuthService } from 'src/app/services/auth.service';
import { HelpersService } from 'src/app/services/helpers.service';
import { FormStateMatcher } from 'src/app/services/form-state-matcher';
import { User } from 'src/app/services/user'
import { Subject } from 'rxjs';
import { takeUntil } from 'rxjs/operators';

@Component({
  selector: 'app-login',
  templateUrl: './login.component.html',
  styleUrls: ['./login.component.scss']
})
export class LoginComponent implements OnInit {

  constructor(
    private formBuilder: FormBuilder,
    private auth: AuthService,
    private helper: HelpersService,
    private activatedRoute: ActivatedRoute,
    private router: Router
  ) {
    this.loginForm = this.formBuilder.group({
      username: [null, [Validators.required]],
      password: [null, [Validators.required]],
      remember_me: [false]
    });
    this.currentUser = this.helper.currentUser();
    if (this.currentUser !== null) {
      this.router.navigate(['/backend']);
    }
  }

  currentUser: User;
  loginForm: FormGroup;
  fm = new FormStateMatcher();
  private unsubs = new Subject();

  ngOnInit(): void {
  }

  ngOnDestroy(): void {
    this.unsubs.next();
    this.unsubs.complete();
  }

  onSubmit(): void {
    this.login();
  }

  login(): void {
    this.auth
      .login(this.loginForm.get('username').value, this.loginForm.get('password').value, this.loginForm.get('remember_me').value)
      .pipe(takeUntil(this.unsubs))
      .subscribe(({user, token}) => {
        this.setLocalStorage(user, token);
        this.redirectToDashboard();
      }, (err) => {
        this.helper.sbError(err.message);
      })
  }

  private setLocalStorage(user, token){
    localStorage.setItem(this.auth.localUser, JSON.stringify(user));
    localStorage.setItem(this.auth.localToken, token);
  }

  private redirectToDashboard() {
    this.activatedRoute.queryParams.pipe(takeUntil(this.unsubs))
    .subscribe(({returnUrl}) => {
      const route = returnUrl ? returnUrl : '/backend/dashboard';
      setTimeout(() => {
        this.router.navigate([route]);
      }, 500);
    });
  }

}
