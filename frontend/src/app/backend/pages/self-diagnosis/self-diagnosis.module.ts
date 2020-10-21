import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { SelfDiagnosisComponent } from './self-diagnosis.component';
import { RouterModule, Routes } from '@angular/router';

const routes: Routes = [
  {
    path: '',
    component: SelfDiagnosisComponent,
    pathMatch: 'full'
  },
]

@NgModule({
  declarations: [SelfDiagnosisComponent],
  imports: [
    CommonModule,
    RouterModule.forChild(routes)
  ]
})
export class SelfDiagnosisModule { }
