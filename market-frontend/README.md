# Market Management System

## Overview
This project is a Market Management System designed to handle product and product type registrations along with managing sales. It utilizes a React frontend and a Node.js backend with a PostgreSQL database.

## Features
- Product registration
- Product type management
- Sales tracking

## Prerequisites
Before you begin, ensure you have met the following requirements:
- Docker and Docker Compose installed for running PostgreSQL
- PHP installed on your local machine
- Node.js and npm installed for handling the frontend
- Any local web server software like XAMPP, WAMP for PHP or direct use of PHP's built-in server

## Technology Stack
- **Frontend**: React, Bootstrap for styling
- **Backend**: PHP
- **Database**: PostgreSQL

## Setup

### Clone the repository
Clone this repository to your local machine using the following command:
```bash
git clone https://github.com/yourusername/market-system.git
cd market-system
```

## Enviroment Setup
Copy the example environment file and modify it according to your needs:
```bash
cp .env.example .env
```

## Start the Database
Navigate to the root directory of the project and run
```bash 
docker-compose up -d
```
This command starts the PostgreSQL database using Docker. The database is pre-populated with the necessary tables using the scripts in the docker/postgres directory.

## Install Node Dependencies
``` bash 
cd market-frontend
npm install
```

## Start the Backend Server
Navigate to the backend directory and start the server:
```bash
cd ..
php -S localhost:8080
``` 

## Start the Frontend Application
Open a new terminal, navigate to the frontend directory, and start the React application:
```bash
cd market-frontend
npm start
```
## Usage
Once all services are started, you can access the application by navigating to http://localhost:3000 in your web browser.

## Contributing
Contributions to this project are welcome. Please ensure to update tests as appropriate.

## License
This project is licensed under the MIT License - see the LICENSE file for details.