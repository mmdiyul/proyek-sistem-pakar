import { Component, OnInit } from '@angular/core';
import { FormBuilder, FormGroup, Validators } from '@angular/forms';
import { ActivatedRoute, Router } from '@angular/router';
import { HelpersService } from 'src/app/services/helpers.service';
import { DiseaseRules } from 'src/app/services/disease-rules';
import { DiseaseRulesService } from '../../../../services/disease-rules.service';
import { Subject } from 'rxjs';
import { takeUntil } from 'rxjs/operators';
import { DiseasesService } from 'src/app/services/diseases.service';
import { SymptomsService } from 'src/app/services/symptoms.service';
import { Diseases } from 'src/app/services/diseases';
import { Symptoms } from 'src/app/services/symptoms';

@Component({
  selector: 'app-disease-rules-action',
  templateUrl: './disease-rules-action.component.html',
  styleUrls: ['./disease-rules-action.component.scss']
})
export class DiseaseRulesActionComponent implements OnInit {

  constructor(
    private service: DiseaseRulesService,
    private router: Router,
    private activatedRoute: ActivatedRoute,
    private fb: FormBuilder,
    private helper: HelpersService,
    private srvDisease: DiseasesService,
    private srvSymptoms: SymptomsService
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
  subject = 'code';
  isLoading: boolean;
  query: any;
  diseases: Diseases[];
  symptoms: Symptoms[];

  createForm(): void {
    this.form = this.fb.group({
      code: [null, [Validators.required]],
      disease_id: [null, [Validators.required]],
      symptoms: [[], [Validators.required]]
    })
  }

  ngOnInit(): void {
    this.getDiseases();
    this.getSymptoms();
  }

  getDiseases(): void {
    this.isLoading = true;
    this.srvDisease
      .getAll()
      .pipe(takeUntil(this.unsubs))
      .subscribe(({data}) => {
        this.diseases = data;
        this.isLoading = false;
      }, (err) => {
        this.helper.sbError(err.message);
        this.isLoading = false;
      })
  }

  getSymptoms(): void {
    this.isLoading = true;
    this.srvSymptoms
      .getAll()
      .pipe(takeUntil(this.unsubs))
      .subscribe(({data}) => {
        this.symptoms = data;
        this.isLoading = false;
      }, (err) => {
        this.helper.sbError(err.message);
        this.isLoading = false;
      })
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
    this.router.navigate(['/backend/disease-rules']);
  }

}
