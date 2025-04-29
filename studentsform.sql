
CREATE TABLE studentsform (
    id INT AUTO_INCREMENT PRIMARY KEY,
    student_id VARCHAR(50) NOT NULL,
    full_name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    phone_number VARCHAR(15) NOT NULL,
    gender ENUM('male', 'female', 'other') NOT NULL,
    course VARCHAR(50) NOT NULL,
    password VARCHAR(255) NOT NULL
);