## Demo

<a href="https://github.com/raflizocky/plagiarism-checker/blob/master/demo-img/Demo.md">View Demo Images</a>

## Features

-   **Superadmin**:

    -   Dashboard: Home page
    -   Similarity Check: CRUD, import, searching, & similarity checking functionality
    -   List Users: CRUD functionality for superadmin & admin data

-   **Admin**:
    -   Dashboard: Home page
    -   Similarity Check: CRUD, import, searching, & similarity checking functionality

## Pre-requisites

-   Min. version:
    -   PHP >= 8.1
    -   Composer
    -   Node.js >= 16.x
    -   XAMPP/MAMP/Laragon/Herd/etc

## Installation

1. Create the database (ex: `plagiarism-checker`)

2. Terminal

    ```shell
    git clone https://github.com/raflizocky/plagiarism-checker.git
    ```

    ```shell
    code plagiarism-checker
    ```

3. `.env`

    - Terminal:
        ```shell
        cp .env.example .env
        ```
    - Adjust `.env`:
        ```shell
        DB_CONNECTION=mysql
        DB_HOST=127.0.0.1
        DB_PORT=3306
        DB_DATABASE=plagiarism-checker
        DB_USERNAME=your_mysql_username
        DB_PASSWORD=your_mysql_password
        ```

4. Open 2 terminal 
    - 1
        ```shell
        composer i ; php artisan key:generate ; php artisan mi:f --seed ; npm i ; npm run dev
        ```
    - 2
    ```shell
      php artisan serve
    ```

## Usage

-   Superadmin

    ```shell
    email   : superadmin@example.com
    password: password
    ```

-   Admin
    ```shell
    email   : admin@example.com
    password: password
    ```

## Contributing

If you encounter any issues or would like to contribute to the project, feel free to:

-   Report any [issues](https://github.com/raflizocky/plagiarism-checker/issues)
-   Submit a [pull request](https://github.com/raflizocky/plagiarism-checker/pulls)
-   Participate in [discussions](https://github.com/raflizocky/plagiarism-checker/discussions) for any questions, feedback, or suggestions

## License

Code released under the [MIT License](https://github.com/raflizocky/plagiarism-checker/blob/master/LICENSE).
