import { Injectable } from '@angular/core';
import { HttpClient, HttpHeaders } from '@angular/common/http';
import { Router } from '@angular/router';

export interface Login {
  user: any;
  token: string;
}

@Injectable({
  providedIn: 'root'
})
export class AuthService {
  localToken = 'pakar-kucing-token';
  localUser = 'pakar-kucing-user';
  
  constructor(
    private http: HttpClient,
    private router: Router
  ) {
    this.token = localStorage.getItem(this.localToken);
  }

  token: string;
  
  isLoggedIn(): boolean {
    return localStorage.getItem(this.localUser) ? true : false;
  }
  
  login(username: string, password: string, remember_me: boolean) {
    const auth = 'Basic ' + btoa(`${username}:${password}`);
    const headers = new HttpHeaders().append('Authorization', auth);
    const url = '/auth/login';
    return this.http.post<Login>(url, { remember_me }, { headers });
  }

  logout() {
    localStorage.removeItem(this.localUser);
    localStorage.removeItem(this.localToken);
    this.router.navigate(['login']);
  }
}
