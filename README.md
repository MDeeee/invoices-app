# Laravel Application

This is a Laravel application that provides an invoicing API.

## Setup

1. Clone the repository:
    ```bash
    git clone https://github.com/MDeeee/invoices-app.git
    ```
2. Navigate to the project directory:
    ```bash
    cd yourrepository
    ```
3. Install the dependencies:
    ```bash
    composer install
    ```
4. Copy the example environment file and make the required configuration changes in the `.env` file:
    ```bash
    cp .env.example .env
    ```
5. Generate a new application key:
    ```bash
    php artisan key:generate
    ```
6. Run the database migrations (Set the database connection in `.env` before migrating):
    ```bash
    php artisan migrate
    ```
7. Seed the database with some test data:
    ```bash
    php artisan db:seed
    ```
    this command will create 
    3 admins (admin1@example.com,admin2@example.com,admin3@example.com) 
    3 customers (customer1@example.com,customer2@example.com,customer3@example.com)
    3 users for each customer (user1-1@example.com,user1-2@example.com,user1-3@example.com,user2-1@example.com,user2-3@example.com ...)
    and 3 sessions for each user

    Password for admin, customer and user: 12345678 

## Testing

You can run the tests for the application using the following command:

```bash
php artisan test
```

## Postman Collection

You can import the Postman collection to test the API endpoints. The collection is located in the `postman` directory in the root of the project.

environment variables:
- base url: http://localhost/api/v1
- token:

## Database Diagram

You can view the database diagram at the following link:

`https://drawsql.app/teams/mdee/diagrams/invoices-app`


## Usage

This application provides an invoicing API with the following endpoints:

**Note** only Admin can create invoces for customers

1. **Create Invoice**: `POST /api/v1/admin/invoices`

   This endpoint creates a new invoice. It accepts a JSON body with the following fields:

   - `start_date`: The start date of the invoice period.
   - `end_date`: The end date of the invoice period.
   - `customer_id`: The ID of the customer for whom the invoice is being created.

   Example request:

   ```json
   {
       "start_date": "2023-01-01",
       "end_date": "2023-02-01",
       "customer_id": 1
   }

   Example response:

   {
       "invoice_id": 1
   }

2. **Get  Invoice**: `GET /api/v1/admin/invoices/{id}`

   This endpoint retrieves the details of an invoice. Replace {id} with the ID of the invoice you want to retrieve.

   Example response:

   {
        "invoice_id": 1,
        "customer_id": 1,
        "start_date": "2023-01-01",
        "end_date": "2023-02-01",
        "total_amount": 1000,
        "details": [
            // ...
        ]
   }

3. **Admin Login**: `POST /api/v1/admin/auth/login`

    This endpoint get admin account information and create Bearer Token to use it on any request

4. **User Login**: `POST /api/v1/user/auth/login`

    This endpoint get user account information and create Bearer Token to use it on any request

5. **Customer Login**: `POST /api/v1/customer/auth/login`

    This endpoint get customer account information and create Bearer Token to use it on any request
