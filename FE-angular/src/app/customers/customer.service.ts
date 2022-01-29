import {Injectable} from '@angular/core';
import {HttpClient, HttpParams} from "@angular/common/http";
import {environment} from "../../environments/environment";
import {map} from "rxjs/operators";
import {Customer} from "./Customer";
import {Subject} from "rxjs";
import {PageMetaInterface} from "../core/Interfaces/page-meta-interface";

@Injectable({
  providedIn: 'root'
})
export class CustomerService {

  url = `${environment.endpoint_url}/customer`;

  customers: Customer[] = [];
  pageMeta: PageMetaInterface = {
    current_page: 1,
    per_page: 15,
    last_page: 1,
    total: 0
  }

  customersChanged = new Subject<Customer[]>();
  isLoadingCustomers = new Subject<boolean>();

  private params: HttpParams

  constructor(private http: HttpClient) {
    this.params = new HttpParams();
  }

  loadCustomers() {
    this.setLoadingState(true);
    this.http.get<{ customers: [], links: [], meta: PageMetaInterface }>(this.url, {params: this.params})
      .pipe(map(response => {
        response.customers.map(customer => new Customer(customer))
        return response;
      }))
      .subscribe(response => {
        this.customers = response.customers;
        this.pageMeta = response.meta;
        this.customersChanged.next(this.customers.slice())
      }, error => {
        this.setLoadingState(false);
      });
  }

  setLoadingState(isLoading: boolean = true) {
    this.isLoadingCustomers.next(isLoading);
  }

  setCountry(country: null | string = null) {
    this.params = this.params.set('country', country ?? '');
    return this;
  }

  setPhoneValid(is_valid: null | boolean = null) {
    this.params = this.params.set('is_valid', is_valid ?? '');
    return this;
  }

  setPage(page: null | number = null) {
    this.params = this.params.set('page', page ?? 1);
    return this;
  }
}
