# Acme Basket - Proof of Concept Basket
 
A simple proof of concept basket for Acme Widget Co new sales system

## Features
 - Add products by code
 - Remove products by code
 - Calculate total price
 - Calculate delivery cost
 - Calculate total price with delivery cost
 - Applies Delivery charge rules based on price

## Structure
-  **Basket.php** - The main class that handles the basket
-  **Catalogue.php** - The catalogue of products
-  **index.php** - The main entry point

## Assumptions made
-  Offers calculate discounts independently,then the basket sums them up
-  Delivery charges are calculated based on the total price of the basket
-  Offers only apply to a single product code
  - Rules are sorted in descending order of threshold
  -  Floating point numbers are rounded to 2 decimal places,so this may introduce some inaccuracy with the amounts

## Getting Started

To get started with the acme-basket, follow these steps:

Clone the Repository:

   ```
   git clone https://github.com/fredrickkisingo/acme-basket.git
   ```

`Set Up Docker:` Make sure you have Docker and Docker Compose installed on your machine:

Build the Docker image
  ```
 docker build -t acme-basket .
   ```

Run the main index.php

  ```
docker-compose run --rm app
   ```

Run tests

 ```
docker-compose run --rm app composer test
   ```





## P.S

If you have any questions or need further assistance, please feel free to reach out to `fredrickkisingo@gmail.com`!
