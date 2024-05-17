import React, { useState } from 'react';
import { Button, Form, FormGroup, Label, Input } from 'reactstrap';

function ProductForm({ onSubmit }) {
  const [name, setName] = useState('');
  const [price, setPrice] = useState('');

  const handleSubmit = (event) => {
    event.preventDefault();
    onSubmit({ name, price });
    setName('');
    setPrice('');
  };

  return (
    <Form onSubmit={handleSubmit}>
      <FormGroup>
        <Label for="productName">Product Name</Label>
        <Input
          type="text"
          name="name"
          id="productName"
          placeholder="Enter product name"
          value={name}
          onChange={e => setName(e.target.value)}
        />
      </FormGroup>
      <FormGroup>
        <Label for="productPrice">Price</Label>
        <Input
          type="number"
          name="price"
          id="productPrice"
          placeholder="Enter product price"
          value={price}
          onChange={e => setPrice(e.target.value)}
        />
      </FormGroup>
      <Button type="submit">Submit</Button>
    </Form>
  );
}

export default ProductForm;
