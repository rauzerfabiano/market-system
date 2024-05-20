import { Component, OnInit, ViewChild } from '@angular/core';
import { Router } from '@angular/router';
import { NgbModal } from '@ng-bootstrap/ng-bootstrap';
import { Sale } from '../../../services/sale/sale.interface';
import { SaleService } from '../../../services/sale/sale.service';

@Component({
  selector: 'app-list-sale',
  templateUrl: './list-sale.component.html',
  styleUrls: ['./list-sale.component.css']
})
export class ListSaleComponent implements OnInit {
  sales: Sale[] = [];
  filteredSales: Sale[] = [];
  searchTerm: string = '';
  productToDelete: Sale | null = null;
  saleDetails: any;
  @ViewChild('deleteModal') deleteModal: any;
  @ViewChild('detailsModal') detailsModal: any;

  constructor(
    private saleService: SaleService,
    private router: Router,
    private modalService: NgbModal
  ) { }

  ngOnInit(): void {
    this.loadSales();
  }

  loadSales(): void {
    this.saleService.getSales()
      .subscribe((data) => {
        this.sales = data;
      });
  }


  deleteSale(sale: Sale): void {
    this.productToDelete = sale;
    if (this.productToDelete) {
      this.modalService.open(this.deleteModal, { centered: true });
    }
  }

  confirmDeleteAction(): void {
    if (this.productToDelete) {
      this.saleService.deleteSale(this.productToDelete.id)
        .subscribe(() => {
          this.loadSales();
        });
    }

    this.productToDelete = null;

    this.modalService.dismissAll();
  }

  addSale(): void {
    this.router.navigate(['/sales/add']);
  }

  openDetailsModal(sale: any) {
    this.saleDetails = sale;
    console.log(sale)
    this.modalService.open(this.detailsModal, { centered: true });
  }
}
