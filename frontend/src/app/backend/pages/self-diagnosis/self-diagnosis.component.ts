import { Component, OnInit } from '@angular/core';
import { FormBuilder, FormGroup, Validators } from '@angular/forms';
import { ActivatedRoute, Router } from '@angular/router';
import { Subject } from 'rxjs';
import { takeUntil } from 'rxjs/operators';
import { DiagnosisHistoryService } from 'src/app/services/diagnosis-history.service';
import { HelpersService } from 'src/app/services/helpers.service';
import { Symptoms } from 'src/app/services/symptoms';
import { SymptomsService } from 'src/app/services/symptoms.service';

@Component({
  selector: 'app-self-diagnosis',
  templateUrl: './self-diagnosis.component.html',
  styleUrls: ['./self-diagnosis.component.scss']
})
export class SelfDiagnosisComponent implements OnInit {

  constructor(
    private router: Router,
    private activatedRoute: ActivatedRoute,
    private fb: FormBuilder,
    private helper: HelpersService,
    private srvDiagnosis: DiagnosisHistoryService,
    private srvSymptoms: SymptomsService
  ) {
    this.createForm();
  }

  form: FormGroup;
  unsubs = new Subject();
  subject = 'id';
  isLoading: boolean;
  query: any;
  symptoms: Symptoms[];

  createForm(): void {
    this.form = this.fb.group({
      disease_id: [1, []],
      symptoms: [[], [Validators.required]]
    })
  }

  ngOnInit(): void {
    this.getSymptoms();
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

  submit(): void {
    if (this.form.valid) {
      this.add();
    }
  }

  add(): void {
    const data = this.form.value;
    this.srvDiagnosis
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

  onBack(): void {
    this.router.navigate(['/backend/diagnosis-history']);
  }

}
