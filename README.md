# Online Voting System

## How to run this application in your computer
- [1] Download or Clone from github
- [2] Create Database using below code
- [3] Run This is application using Terminal & use that `php -S localhost:5000
- [4] Go Brawser to click hear (http://localhost:5000)[http://localhost:5000] 
- [5] Look, show Election System application



## Code

```
CREATE DATABASE election_system_db;

USE election_system_db;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    email VARCHAR(100) NOT NULL UNIQUE,
    role ENUM("admin", "user") DEFAULT "user"
    password VARCHAR(255) NOT NULL,
    has_voted BOOLEAN DEFAULT FALSE
);

CREATE TABLE candidates (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    votes INT DEFAULT 0
);
```
