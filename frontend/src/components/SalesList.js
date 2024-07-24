import React, { useState, useEffect } from 'react';
import axios from 'axios';
import { Container, Typography, Table, TableBody, TableCell, TableContainer, TableHead, TableRow, Paper, Button } from '@mui/material';
import { useNavigate } from 'react-router-dom';

const SalesList = () => {
  const [sales, setSales] = useState([]);
  const navigate = useNavigate();

  useEffect(() => {
    const fetchSales = async () => {
      try {
        const response = await axios.get('http://localhost:8000/sales');
        setSales(response.data);
      } catch (error) {
        console.error('Error fetching sales', error);
      }
    };
    fetchSales();
  }, []);

  const handleCreateSale = () => {
    navigate('/register-sale');
  };

  return (
    <Container>
      <Typography variant="h4" component="h1" gutterBottom>
        Sales List
      </Typography>
      <Button variant="contained" color="primary" onClick={handleCreateSale}>
        Register New Sale
      </Button>
      <TableContainer component={Paper} style={{ marginTop: '16px' }}>
        <Table>
          <TableHead>
            <TableRow>
              <TableCell>ID</TableCell>
              <TableCell>Date</TableCell>
              <TableCell>Total Sale Amount</TableCell>
              <TableCell>Total Tax Amount</TableCell>
            </TableRow>
          </TableHead>
          <TableBody>
            {sales.map((sale) => (
              <TableRow key={sale.id}>
                <TableCell>{sale.id}</TableCell>
                <TableCell>{new Date(sale.createdAt).toLocaleDateString()}</TableCell>
                <TableCell>${sale.totalValue.toFixed(2)}</TableCell>
                <TableCell>${sale.totalTax.toFixed(2)}</TableCell>
              </TableRow>
            ))}
          </TableBody>
        </Table>
      </TableContainer>
    </Container>
  );
};

export default SalesList;