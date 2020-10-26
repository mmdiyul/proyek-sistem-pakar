import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { SymptomsComponent } from './symptoms.component';
import { RouterModule, Routes } from '@angular/router';
import { FormsModule, ReactiveFormsModule } from '@angular/forms';
import { MatButtonModule } from '@angular/material/button';
import { MatCardModule } from '@angular/material/card';
import { MatDialogModule } from '@angular/material/dialog';
import { MatFormFieldModule } from '@angular/material/form-field';
import { MatIconModule } from '@angular/material/icon';
import { MatInputModule } from '@angular/material/input';
import { MatMenuModule } from '@angular/material/menu';
import { MatProgressBarModule } from '@angular/material/progress-bar';
import { MatSelectModule } from '@angular/material/select';
import { MatTableModule } from '@angular/material/table';
import { SymptomsActionComponent } from './symptoms-action/symptoms-action.component';

const routes: Routes = [
  {
    path: '',
    component: SymptomsComponent,
    pathMatch: 'full'
  },
  {
    path: 'action',
    component: SymptomsActionComponent,
    pathMatch: 'full'
  }
]

@NgModule({
  declarations: [SymptomsComponent, SymptomsActionComponent],
  imports: [
    CommonModule,
    RouterModule.forChild(routes),
    MatButtonModule,
    MatProgressBarModule,
    MatTableModule,
    MatMenuModule,
    MatIconModule,
    MatCardModule,
    FormsModule,
    ReactiveFormsModule,
    MatFormFieldModule,
    MatInputModule,
    MatSelectModule,
    MatDialogModule
  ]
})
export class SymptomsModule { }
