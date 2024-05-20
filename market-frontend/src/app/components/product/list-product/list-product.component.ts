import { Component, OnInit, ViewChild } from '@angular/core';
import { Router } from '@angular/router';
import { NgbModal } from '@ng-bootstrap/ng-bootstrap';
import { Product } from '../../../services/product/product.interface';
import { ProductService } from '../../../services/product/product.service';

@Component({
  selector: 'app-list-product',
  templateUrl: './list-product.component.html',
  styleUrls: ['./list-product.component.css']
})
export class ListProductComponent implements OnInit {
  products: Product[] = [];
  filteredProducts: Product[] = [];
  searchTerm: string = '';
  productToDelete: Product | null = null;
  @ViewChild('deleteModal') deleteModal: any; // Adicionando referência ao modal

  constructor(
    private productService: ProductService,
    private router: Router,
    private modalService: NgbModal
  ) { }

  ngOnInit(): void {
    this.loadProducts();
  }

  loadProducts(): void {
    this.productService.getProducts()
      .subscribe((data) => {
        this.products = data;
        this.filterProducts();
      });
  }

  filterProducts(): void {
    this.filteredProducts = this.products.filter(product =>
      product.name.toLowerCase().includes(this.searchTerm.toLowerCase())
    );
  }

  editProduct(product: Product): void {
    this.router.navigate(['/products/edit', product.id]);
  }

  deleteProduct(product: Product): void {
    this.productToDelete = product;
    if (this.productToDelete) {
      this.modalService.open(this.deleteModal, { centered: true });
    }
  }

  confirmDeleteAction(): void {
    if (this.productToDelete) {
      this.productService.deleteProduct(this.productToDelete.id)
        .subscribe(() => {
          this.loadProducts();
        });
    }

    this.productToDelete = null;

    this.modalService.dismissAll();
  }

  addProduct(): void {
    this.router.navigate(['/products/add']);
  }
}
