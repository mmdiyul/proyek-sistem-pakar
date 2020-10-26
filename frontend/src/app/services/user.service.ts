import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { BaseHttpService } from './base-http.service';
import { User } from './user';

@Injectable({
  providedIn: 'root'
})
export class UserService extends BaseHttpService<User> {

  constructor(
    public http: HttpClient
  ) {
    super(http);
    this.endpoint = 'users';
  }
}
