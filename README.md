<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

# Nişantaşı University KEP Progress Tracking Website

This project is maintained by [gorkemkaramolla](https://github.com/gorkemkaramolla) and [burhan-sancakli](https://github.com/burhan-sancakli).

Welcome to the official Laravel website for Nişantaşı University students to track their progress in "KEP" classes.

## Overview

This project was developed and published upon request from Nişantaşı University. It was created in one week and officially launched on February 19th, 2024. The website was accessible at [kepkontrol.nisantasi.edu.tr](http://kepkontrol.nisantasi.edu.tr) until June 10th, 2024.

## Features

- **Student Progress Tracking**: Allows students to monitor their progress in KEP classes.
- **User-Friendly Interface**: Designed to be intuitive and easy to navigate.
- **Secure Access**: Ensures that student data is protected and accessible only to authorized users.

## Technologies Used

- **Laravel**: The PHP framework used for building this website.
- **MySQL**: Database management for storing student data and progress.
- **HTML/CSS**: For the front-end design and layout.
- **JavaScript**: Enhancing user interactions and functionality.

## Installation

To set up this project locally, follow these steps:

1. **Clone the repository**:
   ```bash
   git clone https://github.com/your-repo/kep-progress-tracking.git
   cd kep-progress-tracking
   ```

2. **Install dependencies**:
   ```bash
   composer install
   npm install
   ```

3. **Configure the environment**:
   Rename the `.env.example` file to `.env` and update the necessary environment variables.

4. **Generate application key**:
   ```bash
   php artisan key:generate
   ```

5. **Run migrations**:
   ```bash
   php artisan migrate
   ```

6. **Start the development server**:
   ```bash
   php artisan serve
   ```

## Usage

Once the server is running, you can access the website locally at `http://localhost:8000`.

## Contributing

We welcome contributions to improve this project. Please fork the repository and submit a pull request with your changes.

## License

This project is licensed under the MIT License. See the [LICENSE](LICENSE) file for details.

## Contact

For any inquiries or support, please contact the development team at [support@nisantasi.edu.tr](mailto:support@nisantasi.edu.tr).

---

Thank you for using the Nişantaşı University KEP Progress Tracking Website!
