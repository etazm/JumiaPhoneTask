import {Component, OnInit} from '@angular/core';
import {HttpClient} from "@angular/common/http";
import {environment} from "../../../environments/environment";
import {map} from "rxjs/operators";
import {Country} from "./Country";
import {CustomerService} from "../customer.service";

@Component({
  selector: 'app-customer-filter-form',
  templateUrl: './customer-filter-form.component.html',
  styleUrls: ['./customer-filter-form.component.css']
})
export class CustomerFilterFormComponent implements OnInit {

  public selected_country: string | null = null;
  public is_valid: boolean | null = null;
  public countries: Country[] = [];

  private filterUrl: string = environment.endpoint_url + '/country';

  constructor(private http: HttpClient, private customerService: CustomerService) {
  }

  ngOnInit(): void {
    this.loadCountries();
  }

  loadCountries() {
    this.http.get<{ countries: [] }>(this.filterUrl)
      .pipe<Country[]>(map((responseData) => {
        let countriesArray: Country[] = [];
        responseData.countries.forEach((country) => {
          countriesArray.push(new Country(country))
        });
        return countriesArray
      }))
      .subscribe(countries => {
        this.countries = countries;
      })
  }

  filterChanged() {
    this.customerService
      .setPage(1)
      .setCountry(this.selected_country)
      .setPhoneValid(this.is_valid)
      .loadCustomers()
  }

}
