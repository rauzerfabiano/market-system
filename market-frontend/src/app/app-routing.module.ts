import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';
import { AddProductTypeComponent } from './components/product-type/add-product-type/add-product-type.component';
import { ListProductTypeComponent } from './components/product-type/list-product-type/list-product-type.component';
import { EditProductTypeComponent } from './components/product-type/edit-product-type/edit-product-type.component';
import { AddProductComponent } from './components/product/add-product/add-product.component';
import { EditProductComponent } from './components/product/edit-product/edit-product.component';
import { ListProductComponent } from './components/product/list-product/list-product.component';
import { AddSaleComponent } from './components/sale/add-sale/add-sale.component';
import { ViewSaleComponent } from './components/sale/view-sale/view-sale.component';
import { ListSaleComponent } from './components/sale/list-sale/list-sale.component';


const routes: Routes = [
  { path: '', redirectTo: '', pathMatch: 'full' },
  { path: 'product-types/add', component: AddProductTypeComponent },
  { path: 'product-types/edit/:id', component: EditProductTypeComponent },
  { path: 'product-types', component: ListProductTypeComponent },
  { path: 'products/add', component: AddProductComponent },
  { path: 'products/edit/:id', component: EditProductComponent },
  { path: 'products', component: ListProductComponent },
  { path: 'sales/add', component: AddSaleComponent },
  { path: 'sales/view/:id', component: ViewSaleComponent },
  { path: 'sales', component: ListSaleComponent },
];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule { }
