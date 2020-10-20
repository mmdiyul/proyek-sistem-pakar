import { Injectable, isDevMode } from '@angular/core';
import {
  HttpEvent,
  HttpInterceptor,
  HttpHandler,
  HttpRequest,
} from '@angular/common/http';
import { Observable } from 'rxjs';
import { environment } from './../../environments/environment';

@Injectable({
  providedIn: 'root',
})
export class HttpsInterceptorService implements HttpInterceptor {
  intercept(
    req: HttpRequest<any>,
    next: HttpHandler
  ): Observable<HttpEvent<any>> {
    const match = /^(\/(api|auth).+)/;
    const secureReq = req.clone({
      url: req.url.replace(
        match,
        isDevMode() ? `${environment.host}$1` : `${environment.host}$1`
      ),
    });
    return next.handle(secureReq);
  }
}
