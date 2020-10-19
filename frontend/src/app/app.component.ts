import { Component } from '@angular/core';
import { NavigationEnd, Router } from '@angular/router';
import { filter } from 'rxjs/operators';

@Component({
  selector: 'app-root',
  templateUrl: './app.component.html',
  styleUrls: ['./app.component.scss']
})
export class AppComponent {
  title = 'frontend';

  layout = 'frontend';
  constructor(private router: Router) {
    this.router.events
    .pipe(
      filter((event => event instanceof NavigationEnd)),
      )
      .subscribe((a: NavigationEnd) => {
        this.layout = (a.url.match(/\/(backend)(.+)?/gm)) ? 'backend' : 'frontend';
      });
  }
}
