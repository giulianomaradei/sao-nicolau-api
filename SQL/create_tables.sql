CREATE TABLE persons (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    gender ENUM('M', 'F') NOT NULL,
    email VARCHAR(255) NOT NULL,
    phone VARCHAR(255) NOT NULL,
    zipcode VARCHAR(255) NOT NULL,
    address VARCHAR(255) NOT NULL,
    city VARCHAR(255) NOT NULL,
    state VARCHAR(255) NOT NULL
);

CREATE TABLE employees (
    id INT PRIMARY KEY,
    contract_date DATE NOT NULL,
    password VARCHAR(255) NOT NULL,
    salary DECIMAL(10,2) NOT NULL,
    FOREIGN KEY (id) REFERENCES persons(id)
);

CREATE TABLE doctors (
    id INT PRIMARY KEY,
    crm VARCHAR(255) NOT NULL,
    specialty VARCHAR(255) NOT NULL,
    FOREIGN KEY (id) REFERENCES employees(id)
);

CREATE TABLE patients (
    id INT PRIMARY KEY,
    weight DECIMAL(10,2) NOT NULL,
    height DECIMAL(10,2) NOT NULL,
    blood_type VARCHAR(255) NOT NULL,
    FOREIGN KEY (id) REFERENCES persons(id)
);

CREATE TABLE schedules (
    id INT AUTO_INCREMENT PRIMARY KEY,
    date DATE NOT NULL,
    hour TIME NOT NULL,
    name VARCHAR(255) NOT NULL,
    gender ENUM('M', 'F') NOT NULL,
    email VARCHAR(255) NOT NULL,
    doctor_id INT NOT NULL,
    FOREIGN KEY (doctor_id) REFERENCES doctors(id)
);

