import React from 'react';
import { BrowserRouter as Router, Route, Routes, Link } from 'react-router-dom';
import ProductRegistration from './components/ProductRegistration';
import ProductTypeRegistration from './components/ProductTypeRegistration';
import ProductList from './components/ProductList';
import ProductTypeList from './components/ProductTypeList';
import SalesRegistration from './components/SalesRegistration';
import SalesList from './components/SalesList';
import { Container, AppBar, Toolbar, Typography, Button, Box } from '@mui/material';

const App = () => {
  return (
    <Router>
      <Container>
        <AppBar position="static">
          <Toolbar>
            <Typography variant="h6" component="div" sx={{ flexGrow: 1 }}>
              Product Management
            </Typography>
            <Button color="inherit" component={Link} to="/">
              Home
            </Button>
            <Button color="inherit" component={Link} to="/sales">
              Sales List
            </Button>
            <Button color="inherit" component={Link} to="/products">
              Products
            </Button>
            <Button color="inherit" component={Link} to="/product-types">
              Product Types
            </Button>
          </Toolbar>
        </AppBar>
        <Box mt={4}>
          <Routes>
            <Route path="/" element={<Typography variant="h5">Welcome to the Product Management System</Typography>} />
            <Route path="/register-product" element={<ProductRegistration />} />
            <Route path="/register-product-type" element={<ProductTypeRegistration />} />
            <Route path="/products" element={<ProductList />} />
            <Route path="/product-types" element={<ProductTypeList />} />
            <Route path="/sales" element={<SalesList />} />
            <Route path="/register-sale" element={<SalesRegistration />} />
          </Routes>
        </Box>
      </Container>
    </Router>
  );
};

export default App;