import { Component, OnInit } from '@angular/core';
import { FormBuilder, FormGroup, Validators } from '@angular/forms';
import { ActivatedRoute, Router } from '@angular/router';
import { UserService } from 'src/app/services/user.service';
import { RoleService } from 'src/app/services/role.service';
import { takeUntil } from 'rxjs/operators';
import { Subject } from 'rxjs';
import { Role } from 'src/app/services/role';
import { User } from 'src/app/services/user';
import { HelpersService } from 'src/app/services/helpers.service';

@Component({
  selector: 'app-user-action',
  templateUrl: './user-action.component.html',
  styleUrls: ['./user-action.component.scss']
})
export class UserActionComponent implements OnInit {

  constructor(
    private service: UserService,
    private router: Router,
    private activatedRoute: ActivatedRoute,
    private fb: FormBuilder,
    private helper: HelpersService,
    private srvRoles: RoleService
  ) {
    this.activatedRoute.queryParams.subscribe((query) => {
      this.query = query;
      if (query.m === 'edit') {
        this.getById(this.query.id);
      }
    });
    this.createForm();
    this.getRoles();
  }

  form: FormGroup;
  roles: Role[];
  unsubs = new Subject();
  subject = 'fullname';
  isLoading: boolean;
  query: any;

  createForm(): void {
    this.form = this.fb.group({
      role_id: [null, [Validators.required]],
      fullname: [null, [Validators.required]],
      username: [null, [Validators.required]],
      email: [null, [Validators.required, Validators.email]],
      password: [null, [Validators.required]]
    })
  }

  ngOnInit(): void {
  }

  getById(id: any): void {
    this.isLoading = true;
    this.service
      .getById(id)
      .pipe(takeUntil(this.unsubs))
      .subscribe((data) => {
        const keys = Object.keys(data);
        keys.map((k) => {
          if (this.form.get(k) && data[k]) {
            this.form.get(k).setValue(data[k]);
          }
        });
        this.isLoading = false;
      })
  }

  submit(): void {
    if (this.form.valid) {
      if (this.query.m == 'add') {
        this.add();
      } else {
        this.edit();
      }
    }
  }

  add(): void {
    const data = this.form.value;
    this.service
      .insert(data)
      .pipe(takeUntil(this.unsubs))
      .subscribe(
        () => {
          this.helper.sbSuccess(`${data[this.subject]} disimpan`);
          this.onBack();
        },
        () => this.helper.sbError(`${data[this.subject]} gagal disimpan`)
      )
  }

  edit(): void {
    const data = this.form.value;
    this.service
      .update(this.query.id, data)
      .pipe(takeUntil(this.unsubs))
      .subscribe(
        () => {
          this.helper.sbSuccess(`${data[this.subject]} diperbarui`);
          this.onBack();
        },
        () => this.helper.sbError(`${data[this.subject]} gagal diperbarui`)
      )
  }

  getRoles(): void {
    this.isLoading = true;
    this.srvRoles
      .getAll()
      .pipe(takeUntil(this.unsubs))
      .subscribe(({data}) => {
        this.roles = data;
        this.isLoading = false;
      })
  }

  onBack(): void {
    this.router.navigate(['/backend/users']);
  }

}
