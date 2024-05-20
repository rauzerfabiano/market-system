import { Component, OnInit } from '@angular/core';
import { Product } from '../../../services/product/product.interface';
import { ProductService } from '../../../services/product/product.service';
import { Router } from '@angular/router';
import { NgbModal } from '@ng-bootstrap/ng-bootstrap';
import { SaleService } from '../../../services/sale/sale.service';

@Component({
  selector: 'app-add-sale',
  templateUrl: './add-sale.component.html',
  styleUrls: ['./add-sale.component.css']
})
export class AddSaleComponent implements OnInit {
  products: Product[] = [];
  searchTerm: string = '';
  productToDelete: Product | null = null;
  item: any = {
    quantity: 0,
    product_id: null
  };
  carrinho: any[] = [];
  total: number = 0;
  imposto: number = 0;

  constructor(
    private productService: ProductService,
    private saleService: SaleService,
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
      });
  }

  addProductToCart(): void {
    if (!this.item.product_id || this.item.quantity <= 0) {
      return;
    }

    const selectedProduct = this.products.find(product => product.id == this.item.product_id);

    if (selectedProduct) {
      const newItem = {
        id: selectedProduct.id,
        name: selectedProduct.name,
        price: selectedProduct.price,
        quantity: this.item.quantity,
        tax: selectedProduct.product_type.tax_rate
      };
      this.carrinho.push(newItem);
      this.calculateTotalAndTaxes();
      this.item.quantity = 0;
      this.item.product_id = null;
    }
  }

  removeProductFromCart(index: number): void {
    this.carrinho.splice(index, 1);
    this.calculateTotalAndTaxes();
  }

  calculateTotalAndTaxes(): void {
    this.total = 0;
    this.imposto = 0;
    this.carrinho.forEach(item => {
      this.total += item.price * item.quantity;
      this.imposto = item.tax;
    });
    this.imposto = this.total * (this.imposto/ 100);
  }

  registrarVenda(): void {
    let venda: any = {
      products: []
    };
    for(let i = 0; i < this.carrinho.length; i++){
      venda.products.push({
        product_id: this.carrinho[i].id,
        quantity: this.carrinho[i].quantity
      });
    }
    this.saleService.addSale(venda)
      .subscribe(() => {
        this.carrinho = [];
        this.total = 0;
        this.imposto = 0;
        alert('Venda registrada com sucesso!');
      });

}
}
