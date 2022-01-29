import {Component, OnInit, ViewChild} from '@angular/core';
import {Customer} from "../Customer";
import {CustomerService} from "../customer.service";
import {MatPaginator, PageEvent} from "@angular/material/paginator";
import {PageMetaInterface} from "../../core/Interfaces/page-meta-interface";

@Component({
  selector: 'app-customers-table',
  templateUrl: './customers-table.component.html',
  styleUrls: ['./customers-table.component.css']
})
export class CustomersTableComponent implements OnInit {
  @ViewChild(MatPaginator) paginator: MatPaginator | any;

  customers: Customer[] = [];
  displayedColumns = ['name', 'country', 'state', 'code', 'phone'];

  pageMeta: PageMetaInterface = {
    current_page: 1,
    per_page: 15,
    last_page: 1,
    total: 0
  }

  isLoadingResults: boolean = true;

  constructor(private customerService: CustomerService) {
  }

  ngOnInit(): void {
    this.subscribeIsLoadingCustomer();
    this.subscribeToCustomerChange();
    this.loadCustomers();
  }

  subscribeIsLoadingCustomer() {
    this.customerService
      .isLoadingCustomers
      .subscribe(isLoading => {
        this.isLoadingResults = isLoading
      })
  }

  subscribeToCustomerChange() {
    this.customerService
      .customersChanged
      .subscribe(customers => {
        this.customers = customers
        this.pageMeta = this.customerService.pageMeta;
        this.paginator.pageIndex = this.pageMeta.current_page - 1;
        this.isLoadingResults = false;
      })
  }

  loadCustomers() {
    this.customerService.loadCustomers();
  }

  onChangePage(pe: PageEvent) {
    this.customerService.setPage(pe.pageIndex + 1).loadCustomers();
  }
}
