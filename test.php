create table users(
id int PRIMARY KEY AUTO_INCREMENT,
    role_id int,
user_name varchar(255),
    user_email varchar(255) UNIQUE,
user_password varchar(255),
    created_at timestamp DEFAULT CURRENT_TIMESTAMP,
    FOREIGN key (role_id) REFERENCES role(id)
    
)


CREATE TABLE roles (
    id INT AUTO_INCREMENT PRIMARY KEY,
    role_name VARCHAR(50) NOT NULL
);



CREATE TABLE services (
    id INT AUTO_INCREMENT PRIMARY KEY,
    service_name VARCHAR(100) NOT NULL,
    services_img VARCHAR(255),
    price DECIMAL(10,2)
);


CREATE TABLE staff (
    id INT AUTO_INCREMENT PRIMARY KEY,
	staff_img VARCHAR(255),
    name VARCHAR(100) NOT NULL,
    phone VARCHAR(20)
);


CREATE TABLE clients (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100),
    email VARCHAR(100),
    phone VARCHAR(20)
);

-- TIME SLOTS (daily available slots)
CREATE TABLE time_slots (
    id INT AUTO_INCREMENT PRIMARY KEY,
    slot_time TIME NOT NULL
);

-- APPOINTMENTS
CREATE TABLE appointments (
    id INT AUTO_INCREMENT PRIMARY KEY,
    client_id INT,
    service_id INT,
    staff_id INT,
    appointment_date DATE,
    slot_id INT,
    status ENUM('booked','cancelled','completed') DEFAULT 'booked',
    
    FOREIGN KEY (client_id) REFERENCES clients(id),
    FOREIGN KEY (service_id) REFERENCES services(id),
    FOREIGN KEY (staff_id) REFERENCES staff(id),
    FOREIGN KEY (slot_id) REFERENCES time_slots(id)
);