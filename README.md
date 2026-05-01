# Multi-User Order & Inventory System (Mini SaaS Style)

This is a technical assessment project for a **Jr. Full-Stack Developer** role. It is a mini-SaaS style application built with **Laravel 12** and **Vue.js 3**, featuring a secure ordering and inventory management system.

---

## 🚀 Features

-   **Authentication:** Secure Login/Logout using Laravel Sanctum.
-   **Product Catalog:** Dynamic product list with real-time price and stock info.
-   **Order Management:**
    -   Multi-item cart/ordering system.
    -   Backend validation for product existence and stock availability.
    -   Automatic server-side calculation of the total price.
-   **User Interface:** Responsive Dashboard with Axios integration for seamless API calls.

---

## 🛠 Tech Stack

-   **Backend:** Laravel 12(PHP 8.2+)
-   **Frontend:** Vue.js 3 (Composition API), Vite
-   **Database:** MySQL
-   **API:** RESTful API with Laravel Sanctum

---

## 📂 Database Schema

-   **users:** `id`, `name`, `email`, `password`
-   **products:** `id`, `name`, `price`, `stock`
-   **orders:** `id`, `user_id`, `total_price`
-   **order_items:** `id`, `order_id`, `product_id`, `quantity`, `price`

---

## ⚙️ Installation & Setup

### 1. Backend Setup (Laravel)
1.  **Clone the project:**
    ```bash
 git clone https://github.com/kaung1357/nordic_codetest.git
 cd nordic_codetest/CODETEST-BACKEND
    ```
2.  **Install dependencies:**
    ```bash
    composer install
    ```
3.  **Configure Environment:**
    ```bash
    cp .env.example .env
    # Update your DB_DATABASE, DB_USERNAME, DB_PASSWORD in .env
    ```
4.  **Generate App Key & Migrate:**
    ```bash
    php artisan key:generate
    php artisan migrate --seed
    ```
5.  **Run Server:**
    ```bash
    php artisan serve
    ```

### 2. Frontend Setup (Vue.js)
1.  **Navigate to frontend folder:**
    ```bash
cd nordic_codetest/CODETEST-FRONTEND
    ```
2.  **Install dependencies:**
    ```bash
    npm install
    ```
3.  **Run Development Server:**
    ```bash
    npm run dev
    ```

---

## 📡 API Endpoints

| Method | Endpoint | Description |
| :--- | :--- | :--- |
| `POST` | `/api/login` | User Login & Token Generation |
| `POST` | `/api/logout` | Revoke User Session |
| `GET` | `/api/products` | Retrieve Product List |
| `POST` | `/api/orders` | Submit a New Order |

---

## 💡 Business Logic Implemented

-   **Stock Validation:** Checks if requested quantity is available before processing orders.
-   **Data Integrity:** The total price is calculated on the backend to prevent client-side price manipulation.
-   **Error Handling:** Custom JSON responses for validation failures, out-of-stock items, and unauthorized access.

---

🎥 **Demo Videos:**
- ✅ Normal Flow:  https://youtu.be/43wuahtn6dg
- ❌ Error Handling: https://youtu.be/JJQdfIICi4I


## 👤 Developer Information
-   **Name:** KaungMinKhant
-   **Duration:** 5 Days
-   **Submission Date:1 May 2026
