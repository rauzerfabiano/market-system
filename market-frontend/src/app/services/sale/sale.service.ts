// sale.service.ts

import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Observable } from 'rxjs';
import { Sale } from '../sale/sale.interface';

@Injectable({
  providedIn: 'root'
})
export class SaleService {
  private apiUrl = 'http://127.0.0.1:9090/sales';

  constructor(private http: HttpClient) { }

  getSales(): Observable<Sale[]> {
    return this.http.get<Sale[]>(this.apiUrl, {  });
  }

  addSale(sale: any): Observable<Sale> {
    return this.http.post<Sale>(this.apiUrl, sale);
  }

  getSale(id: number): Observable<Sale> {
    const url = `${this.apiUrl}/${id}`;
    return this.http.get<Sale>(url);
  }

  deleteSale(saleId: number): Observable<void> {
    const url = `${this.apiUrl}/sales/${saleId}`;
    return this.http.delete<void>(url);
  }
}
