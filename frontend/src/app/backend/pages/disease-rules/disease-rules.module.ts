import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { DiseaseRulesComponent } from './disease-rules.component';
import { RouterModule, Routes } from '@angular/router';

const routes: Routes = [
  {
    path: '',
    component: DiseaseRulesComponent,
    pathMatch: 'full'
  },
]

@NgModule({
  declarations: [DiseaseRulesComponent],
  imports: [
    CommonModule,
    RouterModule.forChild(routes)
  ]
})
export class DiseaseRulesModule { }
