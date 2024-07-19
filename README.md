
# Student Archive

StudentArchive is a Laravel-based web application designed to manage and archive student records. This application allows you to upload student data from Excel files, view student information, and search or filter records by class.

## Features
1. Upload Student Records: Easily upload student information from Excel files.
2. View Student Information: Display and manage student records in a clean tabular format.
3. Search and Filter: Search students by name or contact and filter records by class.

## Technologies Used

1. Laravel: A powerful PHP framework for building web applications.
2. Excel Import: Handling Excel file imports using PhpSpreadsheet.
3. SQLite: Database management (easily configurable to other databases).

## Prerequisites

1. PHP (>= 7.4)
2. Composer
3. Laravel (>= 11.x)
4. Git

## Installation

1. **Clone the repository**:
    ```bash
    git clone https://github.com/TakaREN78/studentArchive.git
    cd studentArchive
    ```

2. **Install PHP dependencies**:
    ```bash
    composer install
    ```

3. **Set up environment variables**:
    ```bash
    cp .env.example .env
    ```
    Open the `.env` file and configure your database and other settings.

4. **Generate application key**:
    ```bash
    php artisan key:generate
    ```
    
5. **Set Up Database**:
    ```javascript
    DB_CONNECTION=sqlite
    DB_DATABASE=/path/to/database.sqlite
    ```
    
6. **Run migrations**:
    ```bash
    php artisan migrate
    ```

7. **Serve the application**:
    ```bash
    php artisan serve
    ```

8. **Access the application**:
    Open your web browser and go to `http://127.0.0.1:8000`. You will be redirected to the record page.

## Contributing
Contributions are welcome! Please follow these steps:

1. Fork the repository.
2. Create a new branch (git checkout -b feature-branch).
3. Commit your changes (git commit -am 'Add new feature').
4. Push to the branch (git push origin feature-branch).
5. Create a new Pull Request.

## License
This project is open-source software licensed under the MIT license.

## Contact
For any questions or issues, please contact TakaREN78.






