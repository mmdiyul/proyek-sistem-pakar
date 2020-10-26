import { Component, OnInit } from '@angular/core';
import { FormBuilder, FormGroup, Validators } from '@angular/forms';
import { ActivatedRoute, Router } from '@angular/router';
import { Subject } from 'rxjs';
import { takeUntil } from 'rxjs/operators';
import { HelpersService } from 'src/app/services/helpers.service';
import { SymptomsService } from 'src/app/services/symptoms.service';

@Component({
  selector: 'app-symptoms-action',
  templateUrl: './symptoms-action.component.html',
  styleUrls: ['./symptoms-action.component.scss']
})
export class SymptomsActionComponent implements OnInit {

  constructor(
    private service: SymptomsService,
    private router: Router,
    private activatedRoute: ActivatedRoute,
    private fb: FormBuilder,
    private helper: HelpersService
  ) {
    this.activatedRoute.queryParams.subscribe((query) => {
      this.query = query;
      if (query.m === 'edit') {
        this.getById(this.query.id);
      }
    });
    this.createForm();
  }

  form: FormGroup;
  unsubs = new Subject();
  subject = 'name';
  isLoading: boolean;
  query: any;

  createForm(): void {
    this.form = this.fb.group({
      code: [null, [Validators.required]],
      name: [null, [Validators.required]],
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

  onBack(): void {
    this.router.navigate(['/backend/symptoms']);
  }

}
