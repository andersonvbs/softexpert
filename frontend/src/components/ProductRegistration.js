import React, { useState, useEffect } from 'react';
import axios from 'axios';
import { Container, TextField, Button, Typography, Box } from '@mui/material';

const ProductRegistration = () => {
  const [name, setName] = useState('');
  const [productTypeId, setProductTypeId] = useState('');
  const [price, setPrice] = useState('');
  const [productTypes, setProductTypes] = useState([]);

  useEffect(() => {
    const fetchProductTypes = async () => {
      try {
        const response = await axios.get('http://localhost:8000/product_types');
        setProductTypes(response.data);
      } catch (error) {
        console.error('Error fetching product types', error);
      }
    };
    fetchProductTypes();
  }, []);

  const handleSubmit = async (e) => {
    e.preventDefault();
    try {
      await axios.post('http://localhost:8000/products', { name, product_type_id: productTypeId, price });
      setName('');
      setProductTypeId('');
      setPrice('');
      alert('Product registered successfully!');
    } catch (error) {
      console.error('Error registering product', error);
      alert('Error registering product');
    }
  };

  return (
    <Container>
      <Typography variant="h4" component="h1" gutterBottom>
        Register Product
      </Typography>
      <form onSubmit={handleSubmit}>
        <Box mb={2}>
          <TextField
            label="Product Name"
            variant="outlined"
            fullWidth
            value={name}
            onChange={(e) => setName(e.target.value)}
          />
        </Box>
        <Box mb={2}>
          <TextField
            select
            label="Product Type"
            variant="outlined"
            fullWidth
            value={productTypeId}
            onChange={(e) => setProductTypeId(e.target.value)}
            SelectProps={{
              native: true,
            }}
          >
            <option value=""></option>
            {productTypes.map((type) => (
              <option key={type.id} value={type.id}>
                {type.name}
              </option>
            ))}
          </TextField>
        </Box>
        <Box mb={2}>
          <TextField
            label="Price"
            variant="outlined"
            fullWidth
            type="number"
            value={price}
            onChange={(e) => setPrice(e.target.value)}
          />
        </Box>
        <Button type="submit" variant="contained" color="primary">
          Register
        </Button>
      </form>
    </Container>
  );
};

export default ProductRegistration;