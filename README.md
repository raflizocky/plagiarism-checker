# Plagiarism Checker App

An app that compares and evaluates the similarity between different titles.

## Demo

<a href="https://github.com/raflizocky/plagiarism-checker/blob/main/demo-img/Demo.md">View Demo Images</a>

## Features

-   **Superadmin**:

    -   Dashboard: Home page
    -   Similarity Check: CRUD, import, searching, & similarity checking functionality
    -   List Users: CRUD functionality for superadmin & admin data

-   **Admin**:
    -   Dashboard: Home page
    -   Similarity Check: CRUD, import, searching, & similarity checking functionality

## Pre-requisites

-   Updated at: 2024-12-28
-   Min. version:
    -   PHP >= 8.1
    -   Composer
    -   Node.js
    -   NPM
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

4. Terminal
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

## License

```
Copyright (c) 2024 Rafli Zocky Leonard

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all
copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
SOFTWARE.
```
