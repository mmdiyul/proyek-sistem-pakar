import { AfterViewInit, Component, OnDestroy, OnInit } from '@angular/core';
import { takeUntil } from 'rxjs/operators';
import { RemoveDialogComponent } from '../../components/remove-dialog/remove-dialog.component';
import { DiseaseRules } from 'src/app/services/disease-rules';
import { DiseaseRulessService } from '../../../services/disease-rules.service';
import { Subject } from 'rxjs';
import { HelpersService } from 'src/app/services/helpers.service';
import { ActivatedRoute, Router } from '@angular/router';
import { MatDialog } from '@angular/material/dialog';

@Component({
  selector: 'app-disease-rules',
  templateUrl: './disease-rules.component.html',
  styleUrls: ['./disease-rules.component.scss']
})
export class DiseaseRulesComponent implements OnInit, OnDestroy, AfterViewInit {

  isLoading: boolean;
  dataSource: DiseaseRules[];
  resultLength: number;
  unsubs = new Subject();
  displayedColumns: string[] = ['no', 'code', 'disease', 'symptoms', 'actions'];
  private subject = 'code';
  private primaryKey = 'id';

  constructor(
    private service: DiseaseRulessService,
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

  edit(data: DiseaseRules): void {
    this.router.navigate(['./action'], {
      relativeTo: this.activatedRoute,
      queryParams: {
        m: 'edit',
        id: data[this.primaryKey]
      },
    });
  }

  remove(data: DiseaseRules) {
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
