# Wittix Project

This project is built using Laravel and Vue.js with MySQL as the database.

## Requirements

-   PHP >= 7.4
-   Composer
-   Node.js & npm
-   MySQL

## Installation

1. Clone the repository:

    ```sh
    git clone https://github.com/yourusername/wittix_project.git
    cd wittix_project
    ```

2. Install PHP dependencies:

    ```sh
    composer install
    ```

3. Install JavaScript dependencies:

    ```sh
    npm install
    ```

4. Copy the `.env.example` to `.env` and configure your environment variables:

    ```sh
    cp .env.example .env
    ```

5. Generate the application key:

    ```sh
    php artisan key:generate
    ```

6. Run the database migrations:

    ```sh
    php artisan migrate
    ```

7. Build the frontend assets:
    ```sh
    npm run dev
    ```

## Usage

Start the development server:

```sh
php artisan serve
```

Compile assets for development:

```sh
npm run dev
```

Compile assets for production:

```sh
npm run production
```

## Contributing

Contributions are welcome! Please submit a pull request or open an issue to discuss changes.

## License

This project is licensed under the MIT License.
