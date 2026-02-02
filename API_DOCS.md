# PetMart API Documentation

The PetMart API provides access to product information.

## Endpoints

### 1. Get All Products
Retrieves a list of all available products.

- **URL**: `/api/v1/products`
- **Method**: `GET`
- **Auth Conditions**: Public
- **Response**:

```json
[
  {
    "id": 1,
    "name": "Dog Food",
    "price": 5000,
    "description": "Premium dog food...",
    "brand": "Pedigree",
    ...
  },
  ...
]
```

### 2. Get Single Product
Retrieves details of a specific product.

- **URL**: `/api/v1/products/{id}`
- **Method**: `GET`
- **Auth Conditions**: Public
- **Response**:

```json
{
  "id": 1,
  "name": "Dog Food",
  "price": 5000,
  "description": "Premium dog food...",
  ...
}
```
