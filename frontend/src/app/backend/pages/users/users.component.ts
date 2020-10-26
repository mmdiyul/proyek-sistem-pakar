import { AfterViewInit, Component, OnDestroy, OnInit } from '@angular/core';
import { ActivatedRoute, Router } from '@angular/router';
import { Subject } from 'rxjs';
import { takeUntil } from 'rxjs/operators';
import { HelpersService } from 'src/app/services/helpers.service';
import { User } from 'src/app/services/user';
import { UserService } from '../../../services/user.service';
import { MatDialog } from '@angular/material/dialog';
import { RemoveDialogComponent } from '../../components/remove-dialog/remove-dialog.component';

@Component({
  selector: 'app-users',
  templateUrl: './users.component.html',
  styleUrls: ['./users.component.scss']
})
export class UsersComponent implements OnInit, OnDestroy, AfterViewInit {

  isLoading: boolean;
  dataSource: User[];
  resultLength: number;
  unsubs = new Subject();
  displayedColumns: string[] = ['no', 'fullname', 'email', 'role', 'last_login', 'actions'];
  private subject = 'fullname';
  private primaryKey = 'id';

  constructor(
    private service: UserService,
    private helper: HelpersService,
    private router: Router,
    private activatedRoute: ActivatedRoute,
    public dialog: MatDialog,
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

  edit(data: User): void {
    this.router.navigate(['./action'], {
      relativeTo: this.activatedRoute,
      queryParams: {
        m: 'edit',
        id: data[this.primaryKey]
      },
    });
  }

  remove(data: User) {
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
