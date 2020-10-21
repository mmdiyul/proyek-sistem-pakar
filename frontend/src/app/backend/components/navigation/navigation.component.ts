import { Component } from '@angular/core';
import { BreakpointObserver, Breakpoints } from '@angular/cdk/layout';
import { Observable } from 'rxjs';
import { map, shareReplay } from 'rxjs/operators';
import { HelpersService } from 'src/app/services/helpers.service';
import { AuthService } from 'src/app/services/auth.service';
import { User } from 'src/app/services/user';
import { Menu } from './menu';
import { trigger } from '@angular/animations';

@Component({
  selector: 'app-navigation',
  templateUrl: './navigation.component.html',
  styleUrls: ['./navigation.component.scss']
})
export class NavigationComponent {

  currentUser: User;
  userRolePriority: any;
  menus: Menu[];

  isHandset$: Observable<boolean> = this.breakpointObserver.observe(Breakpoints.Handset)
    .pipe(
      map(result => result.matches),
      shareReplay()
    );

  constructor(
    private breakpointObserver: BreakpointObserver,
    private auth: AuthService,
    private helper: HelpersService
  ) {
    this.currentUser = this.helper.currentUser();
    this.userRolePriority = this.helper.userRolePriority();
    this.menus = [
      {
        name: 'Dashboard',
        url: '/backend/dashboard',
        icon: 'home',
        status: false
      },
      {
        name: 'Daftar Gejala',
        url: '/backend/symptoms',
        icon: 'coronavirus',
        status: this.userRolePriority == 0 ? false : true
      },
      {
        name: 'Daftar Penyakit',
        url: '/backend/diseases',
        icon: 'healing',
        status: this.userRolePriority == 0 ? false : true
      },
      {
        name: 'Daftar Penentuan Penyakit',
        url: '/backend/disease-rules',
        icon: 'rule',
        status: this.userRolePriority == 0 ? false : true
      },
      {
        name: 'Diagnosa Mandiri',
        url: '/backend/self-diagnosis',
        icon: 'grading',
        status: this.userRolePriority == 1 ? false : true
      },
      {
        name: 'Daftar Riwayat Diagnosa',
        url: '/backend/diagnosis-history',
        icon: 'assignment',
        status: false
      },
      {
        name: 'Daftar Pengguna',
        url: '/backend/users',
        icon: 'person',
        status: this.userRolePriority == 0 ? false : true
      },
    ];
  }

  logout() {
    setTimeout(() => {
      this.auth.logout();
    }, 500);
  }

}
