import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { RemoveDialogComponent } from './remove-dialog.component';
import { MatButtonModule } from '@angular/material/button';
import { MatDialogModule } from '@angular/material/dialog';

@NgModule({
  declarations: [RemoveDialogComponent],
  imports: [
    CommonModule,
    MatDialogModule,
    MatButtonModule
  ],
  exports: [
    RemoveDialogComponent
  ],
  entryComponents: [RemoveDialogComponent]
})
export class RemoveDialogModule { }
