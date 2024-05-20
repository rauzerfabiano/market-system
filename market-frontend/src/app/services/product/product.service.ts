// product.service.ts

import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Observable } from 'rxjs';
import { Product } from '../product/product.interface';

@Injectable({
  providedIn: 'root'
})
export class ProductService {
  private apiUrl = 'http://127.0.0.1:9090/products';

  constructor(private http: HttpClient) { }

  getProducts(): Observable<Product[]> {

    return this.http.get<Product[]>(this.apiUrl, {  });
  }

  addProduct(productType: any): Observable<Product> {
    return this.http.post<Product>(this.apiUrl, productType);
  }

  getProduct(id: number): Observable<Product> {
    const url = `${this.apiUrl}/${id}`;
    return this.http.get<Product>(url);
  }

  // Método para atualizar um tipo de produto
  updateProduct(productType: any): Observable<Product> {
    const url = `${this.apiUrl}/${productType.id}`;
    return this.http.put<Product>(url, productType);
  }

  deleteProduct(productId: number): Observable<void> {
    const url = `${this.apiUrl}/products/${productId}`;
    return this.http.delete<void>(url);
  }
}
