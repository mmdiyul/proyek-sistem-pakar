import { Component } from '@angular/core';
import { BreakpointObserver, Breakpoints } from '@angular/cdk/layout';
import { Observable } from 'rxjs';
import { map, shareReplay } from 'rxjs/operators';
import { HelpersService } from 'src/app/services/helpers.service';
import { AuthService } from 'src/app/services/auth.service';
import { User } from 'src/app/services/user';

@Component({
  selector: 'app-navigation',
  templateUrl: './navigation.component.html',
  styleUrls: ['./navigation.component.scss']
})
export class NavigationComponent {

  currentUser: User;

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
    this.currentUser = helper.currentUser();
  }

  logout() {
    setTimeout(() => {
      this.auth.logout();
    }, 500);
  }

}
