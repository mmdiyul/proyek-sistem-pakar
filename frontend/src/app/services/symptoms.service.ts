import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { BaseHttpService } from './base-http.service';
import { Symptoms } from './symptoms';

@Injectable({
  providedIn: 'root'
})
export class SymptomsService extends BaseHttpService<Symptoms> {

  constructor(
    public http: HttpClient
  ) {
    super(http);
    this.endpoint = 'symptoms';
  }
}