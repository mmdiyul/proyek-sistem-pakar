import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { DiagnosisHistoryComponent } from './diagnosis-history.component';
import { RouterModule, Routes } from '@angular/router';

const routes: Routes = [
  {
    path: '',
    component: DiagnosisHistoryComponent,
    pathMatch: 'full'
  },
]

@NgModule({
  declarations: [DiagnosisHistoryComponent],
  imports: [
    CommonModule,
    RouterModule.forChild(routes)
  ]
})
export class DiagnosisHistoryModule { }
