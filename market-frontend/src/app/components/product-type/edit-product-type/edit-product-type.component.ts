import { Component, OnInit } from '@angular/core';
import { ActivatedRoute, Router } from '@angular/router';
import { ProductType } from '../../../services/product-type/product-type.interface';
import { ProductTypeService } from '../../../services/product-type/product-type.service';

@Component({
  selector: 'app-edit-product-type',
  templateUrl: './edit-product-type.component.html',
  styleUrls: ['./edit-product-type.component.css']
})
export class EditProductTypeComponent implements OnInit {
  productType: any = {
    id: 0,
    name: '',
    tax_rate: null
  };

  constructor(
    private route: ActivatedRoute,
    private router: Router,
    private productTypeService: ProductTypeService
  ) { }

  ngOnInit(): void {
    const productId = +this.route.snapshot.params['id']; // Converte o ID para número
    if (!isNaN(productId)) {
      this.productTypeService.getProductType(productId)
        .subscribe((data) => {
          this.productType = data;
        });
    } else {
      console.error('ID do tipo de produto inválido.');
    }
  }

  updateProductType(): void {
    this.productTypeService.updateProductType(this.productType)
      .subscribe(() => {
        this.router.navigate(['/product-types']);
      });
  }
}
