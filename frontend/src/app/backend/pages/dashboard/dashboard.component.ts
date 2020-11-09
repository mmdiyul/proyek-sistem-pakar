import { Component, OnInit } from '@angular/core';
import { Subject } from 'rxjs';
import { takeUntil } from 'rxjs/operators';
import { StatisticService } from 'src/app/services/statistic.service';

@Component({
  selector: 'app-dashboard',
  templateUrl: './dashboard.component.html',
  styleUrls: ['./dashboard.component.scss']
})
export class DashboardComponent implements OnInit {

  constructor(
    private service: StatisticService,
  ) { }

  statistic: any;
  unsubs = new Subject();
  isLoading: any;

  ngOnInit(): void {
    this.isLoading = true;
    this.service
      .getAll()
      .pipe(takeUntil(this.unsubs))
      .subscribe((data) => {
        this.statistic = data;
        this.isLoading = false;
      })
  }

}
