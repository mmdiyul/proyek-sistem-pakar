import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { RouterModule, Routes } from '@angular/router';
import { NavigationModule } from './components/navigation/navigation.module';

const routes: Routes = [
  {
    path: '',
    redirectTo: 'dashboard',
    pathMatch: 'full'
  },
  {
    path: 'dashboard',
    loadChildren: () => import('./pages/dashboard/dashboard.module').then(m => m.DashboardModule)
  },
  {
    path: 'symptoms',
    loadChildren: () => import('./pages/symptoms/symptoms.module').then(m => m.SymptomsModule)
  },
  {
    path: 'diseases',
    loadChildren: () => import('./pages/diseases/diseases.module').then(m => m.DiseasesModule)
  },
  {
    path: 'disease-rules',
    loadChildren: () => import('./pages/disease-rules/disease-rules.module').then(m => m.DiseaseRulesModule)
  },
  {
    path: 'self-diagnosis',
    loadChildren: () => import('./pages/self-diagnosis/self-diagnosis.module').then(m => m.SelfDiagnosisModule)
  },
  {
    path: 'diagnosis-history',
    loadChildren: () => import('./pages/diagnosis-history/diagnosis-history.module').then(m => m.DiagnosisHistoryModule)
  },
  {
    path: 'users',
    loadChildren: () => import('./pages/users/users.module').then(m => m.UsersModule)
  }
];

@NgModule({
  declarations: [],
  imports: [
    CommonModule,
    NavigationModule,
    RouterModule.forChild(routes)
  ],
  exports: [
    NavigationModule
  ]
})
export class BackendModule { }