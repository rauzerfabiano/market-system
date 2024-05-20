import { Component, OnInit, ViewChild } from '@angular/core';
import { Router } from '@angular/router';
import { NgbModal } from '@ng-bootstrap/ng-bootstrap';
import { ProductType } from '../../../services/product-type/product-type.interface';
import { ProductTypeService } from '../../../services/product-type/product-type.service';

@Component({
  selector: 'app-list-product-type',
  templateUrl: './list-product-type.component.html',
  styleUrls: ['./list-product-type.component.css']
})
export class ListProductTypeComponent implements OnInit {
  productTypes: ProductType[] = [];
  filteredProductTypes: ProductType[] = [];
  searchTerm: string = '';
  productToDelete: ProductType | null = null;
  @ViewChild('deleteModal') deleteModal: any; // Adicionando referência ao modal

  constructor(
    private productTypeService: ProductTypeService,
    private router: Router,
    private modalService: NgbModal
  ) { }

  ngOnInit(): void {
    this.loadProductTypes();
  }

  loadProductTypes(): void {
    this.productTypeService.getProductTypes()
      .subscribe((data) => {
        this.productTypes = data;
        this.filterProductTypes();
      });
  }

  filterProductTypes(): void {
    this.filteredProductTypes = this.productTypes.filter(productType =>
      productType.name.toLowerCase().includes(this.searchTerm.toLowerCase())
    );
  }

  editProductType(productType: ProductType): void {
    this.router.navigate(['/product-types/edit', productType.id]);
  }

  deleteProductType(productType: ProductType): void {
    this.productToDelete = productType;
    if (this.productToDelete) {
      this.modalService.open(this.deleteModal, { centered: true });
    }
  }

  confirmDeleteAction(): void {
    if (this.productToDelete) {
      this.productTypeService.deleteProductType(this.productToDelete.id)
        .subscribe(() => {
          this.loadProductTypes();
        });
    }

    this.productToDelete = null;

    this.modalService.dismissAll();
  }

  addProductType(): void {
    this.router.navigate(['/product-types/add']);
  }
}
