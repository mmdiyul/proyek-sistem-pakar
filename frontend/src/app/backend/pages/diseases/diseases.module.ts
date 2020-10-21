import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { DiseasesComponent } from './diseases.component';
import { RouterModule, Routes } from '@angular/router';

const routes: Routes = [
  {
    path: '',
    component: DiseasesComponent,
    pathMatch: 'full'
  },
]

@NgModule({
  declarations: [DiseasesComponent],
  imports: [
    CommonModule,
    RouterModule.forChild(routes)
  ]
})
export class DiseasesModule { }
