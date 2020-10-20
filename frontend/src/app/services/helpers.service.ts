import { AuthService } from './auth.service';
import { MatSnackBar } from '@angular/material/snack-bar';
import { Injectable } from '@angular/core';

@Injectable({
  providedIn: 'root'
})
export class HelpersService {

  constructor(private sb: MatSnackBar, private auth: AuthService) { }

  sbError(message: string, action= null) {
   this.sb.open(message, action ? action : 'Galat', {duration: 5000});
  }

  sbSuccess(message: string, action= null) {
    this.sb.open(message, action ? action : 'Sukses', {duration: 5000});
  }

  currentUser() {
    if (localStorage.getItem(this.auth.localUser)) {
      return JSON.parse(localStorage.getItem(this.auth.localUser));
    }
    return null;
  }
}
