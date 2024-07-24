import React, { useState } from 'react';
import axios from 'axios';
import { Container, TextField, Button, Typography, Box } from '@mui/material';
import { useNavigate } from 'react-router-dom';

const ProductTypeRegistration = () => {
  const [name, setName] = useState('');
  const [taxPercentage, setTaxPercentage] = useState('');
  const navigate = useNavigate();

  const handleSubmit = async (e) => {
    e.preventDefault();
    try {
      await axios.post('http://localhost:8000/product_types', { name, tax_percentage: taxPercentage });
      setName('');
      setTaxPercentage('');
      alert('Product type registered successfully!');
      navigate('/product-types'); // Redirect to the product type list
    } catch (error) {
      console.error('Error registering product type', error);
      alert('Error registering product type');
    }
  };

  return (
    <Container>
      <Typography variant="h4" component="h1" gutterBottom>
        Register Product Type
      </Typography>
      <form onSubmit={handleSubmit}>
        <Box mb={2}>
          <TextField
            label="Product Type Name"
            variant="outlined"
            fullWidth
            value={name}
            onChange={(e) => setName(e.target.value)}
          />
        </Box>
        <Box mb={2}>
          <TextField
            label="Tax Percentage"
            variant="outlined"
            fullWidth
            value={taxPercentage}
            onChange={(e) => setTaxPercentage(e.target.value)}
          />
        </Box>
        <Button type="submit" variant="contained" color="primary">
          Register
        </Button>
      </form>
    </Container>
  );
};

export default ProductTypeRegistration;