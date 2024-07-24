import React, { useState, useEffect } from 'react';
import axios from 'axios';
import { Container, Typography, Button, Table, TableBody, TableCell, TableContainer, TableHead, TableRow, Paper } from '@mui/material';
import { Link } from 'react-router-dom';

const ProductTypeList = () => {
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

  const handleDelete = async (id) => {
    try {
      await axios.delete(`http://localhost:8000/product_types/${id}`);
      setProductTypes(productTypes.filter((type) => type.id !== id));
    } catch (error) {
      console.error('Error deleting product type', error);
      alert('Error deleting product type');
    }
  };

  return (
    <Container>
      <Typography variant="h4" component="h1" gutterBottom>
        Product Types
      </Typography>
      <Button variant="contained" color="primary" component={Link} to="/register-product-type">
        Register New Product Type
      </Button>
      <TableContainer component={Paper} style={{ marginTop: '16px' }}>
        <Table>
          <TableHead>
            <TableRow>
              <TableCell>Name</TableCell>
              <TableCell>Tax Percentage</TableCell>
              <TableCell>Actions</TableCell>
            </TableRow>
          </TableHead>
          <TableBody>
            {productTypes.map((type) => (
              <TableRow key={type.id}>
                <TableCell>{type.name}</TableCell>
                <TableCell>{type.taxPercentage}%</TableCell>
                <TableCell>
                  <Button variant="outlined" color="error" onClick={() => handleDelete(type.id)}>
                    Delete
                  </Button>
                </TableCell>
              </TableRow>
            ))}
          </TableBody>
        </Table>
      </TableContainer>
    </Container>
  );
};

export default ProductTypeList;