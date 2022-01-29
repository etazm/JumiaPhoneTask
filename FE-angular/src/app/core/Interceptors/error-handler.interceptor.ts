import {Injectable} from '@angular/core';
import {
  HttpRequest,
  HttpHandler,
  HttpEvent,
  HttpInterceptor, HttpErrorResponse
} from '@angular/common/http';
import {catchError, Observable, throwError} from 'rxjs';
import {MatSnackBar} from "@angular/material/snack-bar";

@Injectable()
export class ErrorHandlerInterceptor implements HttpInterceptor {
  durationInSeconds = 5 * 1000;

  constructor(private _snackBar: MatSnackBar) {
  }

  intercept(request: HttpRequest<unknown>, next: HttpHandler): Observable<HttpEvent<unknown>> {
    return next.handle(request).pipe(
      catchError((error: HttpErrorResponse) => {
        let errorMsg = '';
        if (error.error instanceof ErrorEvent) {
          console.log('this is client side error');
          console.log(error.error)
          errorMsg = `Error: ${error.error.message ?? 'unknown error'}`;
        } else {
          if (error.status == 422) {
            errorMsg = error.error.message;
          } else {
            console.log('this is server side error');
            console.log('server => ', error.error)
            errorMsg = `Error Code: ${error.status},  Message: ${error.message ?? 'unknown error'}`;
          }
        }
        this._snackBar.open(errorMsg, 'Close', {duration: this.durationInSeconds});
        return throwError(errorMsg);
      })
    );
  }
}
