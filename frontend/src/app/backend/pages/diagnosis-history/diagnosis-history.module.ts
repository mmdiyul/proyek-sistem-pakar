import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { DiagnosisHistoryComponent } from './diagnosis-history.component';
import { RouterModule, Routes } from '@angular/router';
import { MatTableModule } from '@angular/material/table';
import { MatIconModule } from '@angular/material/icon';
import { MatMenuModule } from '@angular/material/menu';
import { MatDialogModule } from '@angular/material/dialog';

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
    RouterModule.forChild(routes),
    MatTableModule,
    MatIconModule,
    MatMenuModule,
    MatDialogModule
  ]
})
export class DiagnosisHistoryModule { }
