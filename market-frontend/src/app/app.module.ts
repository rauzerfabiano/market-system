import { NgModule } from '@angular/core';
import { BrowserModule } from '@angular/platform-browser';

import { AppRoutingModule } from './app-routing.module';
import { AppComponent } from './app.component';
import { FormsModule } from '@angular/forms';
import { HttpClient, HttpClientModule } from '@angular/common/http';
import { AddProductTypeComponent } from './components/product-type/add-product-type/add-product-type.component';
import { ListProductTypeComponent } from './components/product-type/list-product-type/list-product-type.component';
import { MenuComponent } from './components/menu/menu.component';
import { EditProductTypeComponent } from './components/product-type/edit-product-type/edit-product-type.component';
import { AddProductComponent } from './components/product/add-product/add-product.component';
import { EditProductComponent } from './components/product/edit-product/edit-product.component';
import { ListProductComponent } from './components/product/list-product/list-product.component';
import { ListSaleComponent } from './components/sale/list-sale/list-sale.component';
import { AddSaleComponent } from './components/sale/add-sale/add-sale.component';
import { ViewSaleComponent } from './components/sale/view-sale/view-sale.component';

@NgModule({
  declarations: [
    AppComponent,
    AddProductTypeComponent,
    ListProductTypeComponent,
    MenuComponent,
    EditProductTypeComponent,
    AddProductComponent,
    EditProductComponent,
    ListProductComponent,
    ListSaleComponent,
    AddSaleComponent,
    ViewSaleComponent
  ],
  imports: [
    BrowserModule,
    AppRoutingModule,
    FormsModule,
    HttpClientModule
  ],
  providers: [],
  bootstrap: [AppComponent]
})
export class AppModule { }
