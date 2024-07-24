import React, { useState, useEffect } from 'react';
import axios from 'axios';
import { Container, TextField, Button, Typography, Box, Table, TableBody, TableCell, TableContainer, TableHead, TableRow, Paper, IconButton } from '@mui/material';
import { Delete as DeleteIcon } from '@mui/icons-material';
import { useNavigate } from 'react-router-dom';

const SalesRegistration = () => {
  const [products, setProducts] = useState([]);
  const [selectedProduct, setSelectedProduct] = useState('');
  const [quantity, setQuantity] = useState('');
  const [sales, setSales] = useState([]);
  const [totalSaleAmount, setTotalSaleAmount] = useState(0);
  const [totalTaxAmount, setTotalTaxAmount] = useState(0);
  const navigate = useNavigate();

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

  const handleProductChange = (e) => {
    const productId = e.target.value;
    const product = products.find(p => p.id == productId);
    setSelectedProduct(product || null);
  };

  const handleAddProduct = () => {
    if (selectedProduct && quantity > 0) {
      const taxAmount = (selectedProduct.price * selectedProduct.taxPercentage / 100) * quantity;
      const saleAmount = selectedProduct.price * quantity;
      const newSales = [...sales, {
        ...selectedProduct,
        quantity,
        tax_amount: taxAmount,
        sale_amount: saleAmount,
      }];
      console.log({newSales})
      setSales(newSales);
      setTotalSaleAmount(totalSaleAmount + saleAmount);
      setTotalTaxAmount(totalTaxAmount + taxAmount);
      setQuantity('');
      setSelectedProduct(null);
    } else {
      alert('Please select a product and enter a valid quantity');
    }
  };

  const handleRemoveProduct = (index) => {
    const sale = sales[index];
    const updatedSales = sales.filter((_, i) => i !== index);
    setSales(updatedSales);
    setTotalSaleAmount(totalSaleAmount - sale.sale_amount);
    setTotalTaxAmount(totalTaxAmount - sale.tax_amount);
  };

  const handleSubmit = async (e) => {
    e.preventDefault();
    try {
      await axios.post('http://localhost:8000/sales', { products: sales });
      setSales([]);
      setTotalSaleAmount(0);
      setTotalTaxAmount(0);
      alert('Sale registered successfully!');
      navigate('/'); // Redirect to the home page or another appropriate page
    } catch (error) {
      console.error('Error registering sale', error);
      alert('Error registering sale');
    }
  };

  return (
    <Container>
      <Typography variant="h4" component="h1" gutterBottom>
        Register Sale
      </Typography>
      <form onSubmit={handleSubmit}>
        <Box mb={2}>
          <TextField
            select
            label="Product"
            variant="outlined"
            fullWidth
            value={selectedProduct?.id || ''}
            onChange={handleProductChange}
            SelectProps={{
              native: true,
            }}
          >
            <option value=""></option>
            {products.map((product) => (
              <option key={product.id} value={product.id}>
                {product.name} (${product.price})
              </option>
            ))}
          </TextField>
        </Box>
        <Box mb={2}>
          <TextField
            label="Quantity"
            variant="outlined"
            fullWidth
            type="number"
            value={quantity}
            onChange={(e) => setQuantity(e.target.value)}
          />
        </Box>
        <Button type="button" variant="contained" color="primary" onClick={handleAddProduct}>
          Add Product
        </Button>
        <Box mt={4}>
          <Typography variant="h6" component="h2">
            Sales Items
          </Typography>
          <TableContainer component={Paper} style={{ marginTop: '16px' }}>
            <Table>
              <TableHead>
                <TableRow>
                  <TableCell>Product Name</TableCell>
                  <TableCell>Quantity</TableCell>
                  <TableCell>Sale Amount</TableCell>
                  <TableCell>Tax Amount</TableCell>
                  <TableCell>Actions</TableCell>
                </TableRow>
              </TableHead>
              <TableBody>
                {sales.map((sale, index) => (
                  <TableRow key={index}>
                    <TableCell>{sale.name}</TableCell>
                    <TableCell>{sale.quantity}</TableCell>
                    <TableCell>${sale.sale_amount.toFixed(2)}</TableCell>
                    <TableCell>${sale.tax_amount.toFixed(2)}</TableCell>
                    <TableCell>
                      <IconButton onClick={() => handleRemoveProduct(index)} color="secondary">
                        <DeleteIcon />
                      </IconButton>
                    </TableCell>
                  </TableRow>
                ))}
              </TableBody>
            </Table>
          </TableContainer>
          <Box mt={2}>
            <Typography variant="h6" component="h2">
              Total Sale Amount: ${totalSaleAmount.toFixed(2)}
            </Typography>
            <Typography variant="h6" component="h2">
              Total Tax Amount: ${totalTaxAmount.toFixed(2)}
            </Typography>
          </Box>
          <Button type="submit" variant="contained" color="primary" style={{ marginTop: '16px' }}>
            Submit Sale
          </Button>
        </Box>
      </form>
    </Container>
  );
};

export default SalesRegistration;