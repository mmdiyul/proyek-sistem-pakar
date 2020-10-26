import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { BaseHttpService } from './base-http.service';
import { Role } from './role';

@Injectable({
  providedIn: 'root'
})
export class RoleService extends BaseHttpService<Role> {

  constructor(
    public http: HttpClient
  ) {
    super(http);
    this.endpoint = 'roles';
  }
}