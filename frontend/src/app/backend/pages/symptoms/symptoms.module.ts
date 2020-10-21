import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { SymptomsComponent } from './symptoms.component';
import { RouterModule, Routes } from '@angular/router';

const routes: Routes = [
  {
    path: '',
    component: SymptomsComponent,
    pathMatch: 'full'
  },
]

@NgModule({
  declarations: [SymptomsComponent],
  imports: [
    CommonModule,
    RouterModule.forChild(routes)
  ]
})
export class SymptomsModule { }
