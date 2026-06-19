/*CREATE DATABASE skydyReserve; 

USE skydyReserve;
CREATE TABLE space(
	space_id INT PRIMARY KEY AUTO_INCREMENT,
    space_name VARCHAR(50) UNIQUE NOT NULL,
    capacity INT NOT NULL,
    price INT NOT NULL
);

CREATE TABLE workspace(
	space_id INT,
    FOREIGN KEY (space_id) REFERENCES space(space_id),
    is_shared BOOL NOT NULL,
    Has_locker BOOL NOT NULL
);

CREATE TABLE room(
	space_id INT,
    FOREIGN KEY (space_id) REFERENCES space(space_id),
    Soundproof_Level BOOL NOT NULL
);

CREATE TABLE reservation(
	reservation_id INT PRIMARY KEY AUTO_INCREMENT,
    space_id INT,
    FOREIGN KEY (space_id) REFERENCES space(space_id),
    reservation_status ENUM('Confirmed', 'Cancelled', 'Rescheduled', 'Pending') NOT NULL,
    reservation_date DATE NOT NULL,
    reservation_time TIME NOT NULL,
    expected_timeout TIME NOT NULL
);

CREATE TABLE customer(
	customer_id INT PRIdispMARY KEY AUTO_INCREMENT,
    reservation_id INT,
    FOREIGN KEY (reservation_id) REFERENCES reservation(reservation_id),
    first_name VARCHAR(20) NOT NULL,
    middle_name VARCHAR(20),
    last_name VARCHAR(20) NOT NULL,
    suffix VARCHAR(6),
    gender ENUM('Male', 'Female'),
    email_address VARCHAR(50),
    phone_number VARCHAR(11)
);

CREATE TABLE payment(
	payment_id INT PRIMARY KEY AUTO_INCREMENT,
    reservation_id INT,
    FOREIGN KEY (reservation_id) REFERENCES reservation(reservation_id),
    reference_code VARCHAR(20),
    amount_paid INT NOT NULL,
    payment_mode ENUM('Card', 'Cash', 'E-wallet') NOT NULL,
    payment_date_time DATETIME NOT NULL
);