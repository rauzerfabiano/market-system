// product-type.service.ts

import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Observable } from 'rxjs';
import { ProductType } from '../product-type/product-type.interface';

@Injectable({
  providedIn: 'root'
})
export class ProductTypeService {
  private apiUrl = 'http://127.0.0.1:9090/product-types';

  constructor(private http: HttpClient) { }

  getProductTypes(): Observable<ProductType[]> {

    return this.http.get<ProductType[]>(this.apiUrl, {  });
  }

  addProductType(productType: any): Observable<ProductType> {
    return this.http.post<ProductType>(this.apiUrl, productType);
  }

  getProductType(id: number): Observable<ProductType> {
    const url = `${this.apiUrl}/${id}`;
    return this.http.get<ProductType>(url);
  }

  // Método para atualizar um tipo de produto
  updateProductType(productType: any): Observable<ProductType> {
    const url = `${this.apiUrl}/${productType.id}`;
    return this.http.put<ProductType>(url, productType);
  }

  deleteProductType(productId: number): Observable<void> {
    const url = `${this.apiUrl}/product-types/${productId}`; // URL da API para excluir um tipo de produto
    return this.http.delete<void>(url);
  }
}
