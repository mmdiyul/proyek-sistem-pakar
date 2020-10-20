import { Component, OnInit } from '@angular/core';
import { FormBuilder, Validators, FormGroup, AbstractControl } from '@angular/forms';
import { ActivatedRoute, Router } from '@angular/router';
import { Subject } from 'rxjs';
import { takeUntil } from 'rxjs/operators';
import { AuthService } from 'src/app/services/auth.service';
import { FormStateMatcher } from 'src/app/services/form-state-matcher';
import { HelpersService } from 'src/app/services/helpers.service';
import { User } from 'src/app/services/user';

@Component({
  selector: 'app-register',
  templateUrl: './register.component.html',
  styleUrls: ['./register.component.scss']
})
export class RegisterComponent implements OnInit {

  constructor(
    private formBuilder: FormBuilder,
    private auth: AuthService,
    private helper: HelpersService,
    private activatedRoute: ActivatedRoute,
    private router: Router
  ) {
    this.form = this.formBuilder.group({
      fullname: [null, [Validators.required]],
      username: [null, [Validators.required]],
      email: [null, [Validators.required, Validators.email]],
      password: [null, [Validators.required]],
      re_password: [null, [Validators.required, ]],
    }, {
      validators: this.confirmPassword
    });
    this.currentUser = this.helper.currentUser();
    if (this.currentUser !== null) {
      this.router.navigate(['/backend']);
    }
  }

  currentUser: User;
  form: FormGroup;
  fm = new FormStateMatcher();
  private unsubs = new Subject();

  ngOnInit(): void {
  }

  ngOnDestroy(): void {
    this.unsubs.next();
    this.unsubs.complete();
  }

  onSubmit(): void {
    this.register();
  }

  register(): void {
    this.auth
      .register(this.form.value)
      .pipe(takeUntil(this.unsubs))
      .subscribe(() => {
        this.helper.sbSuccess('Register success!');
        this.login();
      }, (err) => {
        this.helper.sbError(err.message ? err.message : err.username ? err.username : err.email ? err.email : null);
      })
  }

  confirmPassword(c: AbstractControl): { invalid: boolean } {
    if (c.get('password').value !== c.get('re_password').value) {
        return {invalid: true};
    }
  }

  login(): void {
    this.router.navigate(['/login']);
  }
}
