import { Component, OnInit } from '@angular/core';
import { Router } from '@angular/router';
import { Product } from '../../../services/product/product.interface';
import { ProductService } from '../../../services/product/product.service';
import { ProductType } from '../../../services/product-type/product-type.interface';
import { ProductTypeService } from '../../../services/product-type/product-type.service';

@Component({
  selector: 'app-add-product',
  templateUrl: './add-product.component.html',
  styleUrls: ['./add-product.component.css']
})
export class AddProductComponent implements OnInit {
  newProduct: any = {
    name: '',
    price: 0,
    product_type: 0
  };
  productTypes: ProductType[] = [];

  constructor(
    private productService: ProductService,
    private productTypeService: ProductTypeService,
    private router: Router
  ) { }

  ngOnInit(): void {
    this.loadProductTypes();
  }

  loadProductTypes(): void {
    this.productTypeService.getProductTypes()
      .subscribe((types: ProductType[]) => {
        this.productTypes = types;
      });
  }

  addProduct(): void {
    this.productService.addProduct(this.newProduct)
      .subscribe(() => {
        this.router.navigate(['/products']);
      });
  }
}
