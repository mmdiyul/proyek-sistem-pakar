import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';

export interface BaseAPI {
  length: number;
  data: [];
}

@Injectable({
  providedIn: 'root'
})
export class BaseHttpService<T> {

  constructor(
    public http: HttpClient
  ) { }

  url() {
    return [this.base_url, this.endpoint].join('/');
  }

  url_id(id) {
    return [this.base_url, this.endpoint, id].join('/');
  }

  base_url = '/api';
  endpoint: string;

  getAll() {
    const url = this.url();
    return this.http.get<BaseAPI>(url);
  }

  getById(id: string) {
    const url = this.url_id(id);
    return this.http.get<T>(url);
  }

  insert(data: any) {
    const url = this.url();
    return this.http.post<T>(url, data);
  }

  update(id: string, data: any) {
    const url = this.url_id(id);
    return this.http.put<T>(url, data);
  }

  remove(id: string) {
    const url = this.url_id(id);
    return this.http.delete<T>(url);
  }
}
