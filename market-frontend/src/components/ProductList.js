import React, { useEffect, useState } from 'react';
import axios from 'axios';

function ProductList() {
    const [products, setProducts] = useState([]);

    useEffect(() => {
        axios.get('/api/products')
    .then(response => {
        // Check if the response is indeed an array
        if (Array.isArray(response.data)) {
            setProducts(response.data);
        } else {
            console.error('Data fetched is not an array:', response.data);
            setProducts([]); // Set to empty array if not array
        }
    })
    .catch(error => {
        console.error('Error loading the products:', error);
        setProducts([]); // Ensure it remains an array even on error
    });
    }, []);

    return (
        <div>
            <h2>Products</h2>
            <ul>
                {products.map(product => (
                    <li key={product.id}>{product.name} - ${product.price}</li>
                ))}
            </ul>
        </div>
    );
}

export default ProductList;
