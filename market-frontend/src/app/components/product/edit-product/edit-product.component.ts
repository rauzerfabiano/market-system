import { Component, OnInit } from '@angular/core';
import { ActivatedRoute, Router } from '@angular/router';
import { Product } from '../../../services/product/product.interface';
import { ProductService } from '../../../services/product/product.service';
import { ProductType } from '../../../services/product-type/product-type.interface';
import { ProductTypeService } from '../../../services/product-type/product-type.service';

@Component({
  selector: 'app-edit-product',
  templateUrl: './edit-product.component.html',
  styleUrls: ['./edit-product.component.css']
})
export class EditProductComponent implements OnInit {
  product: any = {
    name: '',
    price: 0,
    product_type_id: 0
  };
  productTypes: ProductType[] = [];

  constructor(
    private productService: ProductService,
    private productTypeService: ProductTypeService,
    private route: ActivatedRoute,
    private router: Router
  ) { }

  ngOnInit(): void {
    const productId = +this.route.snapshot.params['id']; // Converte o ID para número
    if (!isNaN(productId)) {
      this.productService.getProduct(productId)
        .subscribe((data) => {
          this.product = data;
        });
    } else {
      console.error('ID do tipo de produto inválido.');
    }
    this.loadProductTypes();
  }

  loadProductTypes(): void {
    this.productTypeService.getProductTypes()
      .subscribe((types: ProductType[]) => {
        this.productTypes = types;
      });
  }

  updateProduct(): void {
    this.product.product_type_id = this.product.product_type.id
    this.productService.updateProduct(this.product)
      .subscribe(() => {
        this.router.navigate(['/products']);
      });
  }
}
