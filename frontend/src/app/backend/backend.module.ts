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