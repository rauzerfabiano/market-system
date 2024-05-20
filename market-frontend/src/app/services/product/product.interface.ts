import { ProductType } from "../product-type/product-type.interface";

export interface Product {
  id: number;
  name: string;
  price: number;
  product_type: any
}
