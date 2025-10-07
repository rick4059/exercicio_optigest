CREATE TABLE exercicio_optigest.employees (
	id INT auto_increment NOT NULL,
	name varchar(100) NOT NULL,
	job varchar(100) NOT NULL,
	age INT NOT NULL,
	salary DOUBLE NULL,
	admission_date DATE NOT NULL DEFAULT (CURDATE()),
	CONSTRAINT employees_pk PRIMARY KEY (id)
)
ENGINE=InnoDB
DEFAULT CHARSET=utf8mb4
COLLATE=utf8mb4_general_ci;

CREATE TABLE `projects` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_employee` int(11) NOT NULL,
  `description` varchar(1000) NOT NULL,
  `value` double DEFAULT NULL,
  `status` varchar(100) NOT NULL,
  `delivery_date` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `projects_employees_FK` (`id_employee`),
  CONSTRAINT `projects_employees_FK` FOREIGN KEY (`id_employee`) REFERENCES `employees` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

