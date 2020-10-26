import { AfterViewInit, Component, OnDestroy, OnInit } from '@angular/core';
import { MatDialog } from '@angular/material/dialog';
import { ActivatedRoute, Router } from '@angular/router';
import { Subject } from 'rxjs';
import { takeUntil } from 'rxjs/operators';
import { HelpersService } from 'src/app/services/helpers.service';
import { RemoveDialogComponent } from '../../components/remove-dialog/remove-dialog.component';
import { Symptoms } from 'src/app/services/symptoms';
import { SymptomsService } from '../../../services/symptoms.service';

@Component({
  selector: 'app-symptoms',
  templateUrl: './symptoms.component.html',
  styleUrls: ['./symptoms.component.scss']
})
export class SymptomsComponent implements OnInit, OnDestroy, AfterViewInit {

  isLoading: boolean;
  dataSource: Symptoms[];
  resultLength: number;
  unsubs = new Subject();
  displayedColumns: string[] = ['no', 'code', 'name', 'actions'];
  private subject = 'name';
  private primaryKey = 'id';

  constructor(
    private service: SymptomsService,
    private helper: HelpersService,
    private router: Router,
    private activatedRoute: ActivatedRoute,
    public dialog: MatDialog
  ) { }

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

  edit(data: Symptoms): void {
    this.router.navigate(['./action'], {
      relativeTo: this.activatedRoute,
      queryParams: {
        m: 'edit',
        id: data[this.primaryKey]
      },
    });
  }

  remove(data: Symptoms) {
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
