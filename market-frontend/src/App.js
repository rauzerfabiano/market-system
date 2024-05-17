import React from 'react';
import 'bootstrap/dist/css/bootstrap.min.css'; // Ensure Bootstrap is imported if using it
import ProductForm from './components/ProductForm';
import ProductList from './components/ProductList';

function App() {
  const handleProductSubmit = (product) => {
    // Example: Post to backend
    console.log('Submitting product', product);
    // You might use fetch or axios here to post data to your backend
  };

  return (
    <div className="App">
      <h1>Market Management System</h1>
      <ProductForm onSubmit={handleProductSubmit} />
      <ProductList />
    </div>
  );
}

export default App;
