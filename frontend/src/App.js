import React from 'react';
import { BrowserRouter as Router, Route, Routes, Link } from 'react-router-dom';
import ProductRegistration from './components/ProductRegistration';
import ProductTypeRegistration from './components/ProductTypeRegistration';
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
            <Button color="inherit" component={Link} to="/register-product">
              Register Product
            </Button>
            <Button color="inherit" component={Link} to="/register-product-type">
              Register Product Type
            </Button>
          </Toolbar>
        </AppBar>
        <Box mt={4}>
          <Routes>
            <Route path="/" element={<Typography variant="h5">Welcome to the Product Management System</Typography>} />
            <Route path="/register-product" element={<ProductRegistration />} />
            <Route path="/register-product-type" element={<ProductTypeRegistration />} />
          </Routes>
        </Box>
      </Container>
    </Router>
  );
};

export default App;