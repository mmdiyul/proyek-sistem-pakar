import { Component, OnInit } from '@angular/core';
import { MatDialog } from '@angular/material/dialog';
import { ActivatedRoute, Router } from '@angular/router';
import { Subject } from 'rxjs';
import { takeUntil } from 'rxjs/operators';
import { DiagnosisHistoryService } from 'src/app/services/diagnosis-history.service';
import { HelpersService } from 'src/app/services/helpers.service';
import { RemoveDialogComponent } from '../../components/remove-dialog/remove-dialog.component';

@Component({
  selector: 'app-diagnosis-history',
  templateUrl: './diagnosis-history.component.html',
  styleUrls: ['./diagnosis-history.component.scss']
})
export class DiagnosisHistoryComponent implements OnInit {

  isLoading: boolean;
  dataSource: any[];
  resultLength: number;
  unsubs = new Subject();
  displayedColumns: string[];
  private subject = 'id';
  private primaryKey = 'id';

  constructor(
    private service: DiagnosisHistoryService,
    private helper: HelpersService,
    private router: Router,
    private activatedRoute: ActivatedRoute,
    public dialog: MatDialog
  ) {
    const rolePrior = this.helper.currentUser().role.priority;
    if (rolePrior > 0) {
      this.displayedColumns = ['no', 'disease', 'symptoms', 'solution', 'created_at'];
    } else {
      this.displayedColumns = ['no', 'disease', 'symptoms', 'solution', 'created_at', 'actions'];
    }
  }

  ngOnInit(): void {
    this.getData();
  }

  ngAfterViewInit(): void {

  }

  ngOnDestroy(): void {
    this.unsubs.next();
    this.unsubs.complete();
  }

  getData(): void {
    this.isLoading = true;
    this.service
      .getAll()
      .pipe(takeUntil(this.unsubs))
      .subscribe(({length, data}) => {
        this.dataSource = data;
        this.resultLength = length;
        this.isLoading = false;
      }, (err) => {
        this.isLoading = false;
        this.helper.sbError(err.message);
      })
  }

  add(): void {
    this.router.navigate(['./action'], {
      relativeTo: this.activatedRoute,
      queryParams: {
        m: 'add',
      },
    });
  }

  edit(data: any): void {
    this.router.navigate(['./action'], {
      relativeTo: this.activatedRoute,
      queryParams: {
        m: 'edit',
        id: data[this.primaryKey]
      },
    });
  }

  remove(data: any) {
    this.dialog
      .open(RemoveDialogComponent)
      .afterClosed()
      .subscribe((result) => {
        if (result) {
          this.service
            .remove(data[this.primaryKey])
            .pipe(takeUntil(this.unsubs))
            .subscribe(
              () => {
                this.getData();
                this.helper.sbSuccess(`${data[this.subject]} dihapus`);
              },
              (err) => {
                this.helper.sbError(err.message);
              }
            );
        }
      });
  }

}
