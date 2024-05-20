import { Component } from '@angular/core';
import { Router } from '@angular/router';
import { ProductType } from '../../../services/product-type/product-type.interface';
import { ProductTypeService } from '../../../services/product-type/product-type.service';

@Component({
  selector: 'app-add-product-type',
  templateUrl: './add-product-type.component.html',
  styleUrls: ['./add-product-type.component.css']
})
export class AddProductTypeComponent {
  newProductType: any = {
    name: '',
    tax_rate: 0
  };

  constructor(
    private productTypeService: ProductTypeService,
    private router: Router
  ) { }

  addProductType(): void {
    this.productTypeService.addProductType(this.newProductType)
      .subscribe(() => {
        this.router.navigate(['/product-types']);
      });
  }
}
