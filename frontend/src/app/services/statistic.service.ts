import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { BaseHttpService } from './base-http.service';

@Injectable({
  providedIn: 'root'
})
export class StatisticService extends BaseHttpService<any> {

  constructor(
    public http: HttpClient
  ) {
    super(http);
    this.endpoint = 'statistik';
  }
}