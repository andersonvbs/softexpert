import React, { useState, useEffect } from 'react';
import axios from 'axios';
import { Container, Typography, Button, Table, TableBody, TableCell, TableContainer, TableHead, TableRow, Paper } from '@mui/material';
import { Link } from 'react-router-dom';

const ProductList = () => {
  const [products, setProducts] = useState([]);

  useEffect(() => {
    const fetchProducts = async () => {
      try {
        const response = await axios.get('http://localhost:8000/products');
        setProducts(response.data);
      } catch (error) {
        console.error('Error fetching products', error);
      }
    };
    fetchProducts();
  }, []);

  const handleDelete = async (id) => {
    try {
      await axios.delete(`http://localhost:8000/products/${id}`);
      setProducts(products.filter((product) => product.id !== id));
    } catch (error) {
      console.error('Error deleting product', error);
      alert('Error deleting product');
    }
  };

  return (
    <Container>
      <Typography variant="h4" component="h1" gutterBottom>
        Products
      </Typography>
      <Button variant="contained" color="primary" component={Link} to="/register-product">
        Register New Product
      </Button>
      <TableContainer component={Paper} style={{ marginTop: '16px' }}>
        <Table>
          <TableHead>
            <TableRow>
              <TableCell>Name</TableCell>
              <TableCell>Type</TableCell>
              <TableCell>Price</TableCell>
              <TableCell>Actions</TableCell>
            </TableRow>
          </TableHead>
          <TableBody>
            {products.map((product) => (
              <TableRow key={product.id}>
                <TableCell>{product.name}</TableCell>
                <TableCell>{product.productTypeName}</TableCell>
                <TableCell>${product.price}</TableCell>
                <TableCell>
                  <Button variant="outlined" color="error" onClick={() => handleDelete(product.id)}>
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

export default ProductList;