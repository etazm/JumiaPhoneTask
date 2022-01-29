export class Country {
  private readonly _name: string;
  private readonly _code: string;


  constructor(countryData: { name: string, code: string }) {
    this._name = countryData.name;
    this._code = countryData.code;
  }

  get name(): string {
    return this._name;
  }

  get code(): string {
    return this._code;
  }
}
