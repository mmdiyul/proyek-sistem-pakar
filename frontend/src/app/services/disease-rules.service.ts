import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { BaseHttpService } from './base-http.service';
import { DiseaseRules } from './disease-rules';

@Injectable({
  providedIn: 'root'
})
export class DiseaseRulessService extends BaseHttpService<DiseaseRules> {

  constructor(
    public http: HttpClient
  ) {
    super(http);
    this.endpoint = 'disease-rules';
  }
}