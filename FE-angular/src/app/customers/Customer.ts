export class Customer {
  private id: number;
  private name: string;
  private country: string;
  private code: string;
  private phone: string;

  constructor(customerData: { id: number, name: string, country: string, code: string, phone: string }) {
    this.id = customerData.id;
    this.name = customerData.name;
    this.country = customerData.country;
    this.code = customerData.code;
    this.phone = customerData.phone;
  }
}
