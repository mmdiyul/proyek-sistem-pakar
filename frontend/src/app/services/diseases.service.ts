import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { BaseHttpService } from './base-http.service';
import { Diseases } from './diseases';

@Injectable({
  providedIn: 'root'
})
export class DiseasesService extends BaseHttpService<Diseases> {

  constructor(
    public http: HttpClient
  ) {
    super(http);
    this.endpoint = 'diseases';
  }
}