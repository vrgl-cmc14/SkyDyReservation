
CREATE DATABASE display;
CREATE TABLE disp(
	disp_id INT AUTO_INCREMENT PRIMARY KEY,
    disp_name VARCHAR(20) NOT NULL UNIQUE,
    disp_rentCat ENUM("Hour", "Whole Day") NOT NULL,
    disp_price INT NOT NULL,
    disp_description MEDIUMTEXT NOT NULL,
    disp_image LONGBLOB NOT NULL
);

