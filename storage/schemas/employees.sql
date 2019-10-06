DROP TABLE IF EXISTS `employee_employees`;
DROP TABLE IF EXISTS `employees`;
CREATE TABLE `employees` (
    `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
    `name` varchar(70) NOT NULL,
    `surname` varchar(100) DEFAULT NULL,
    `email` varchar(70) DEFAULT NULL,
    `address` varchar(200) DEFAULT NULL,
    `risk` int DEFAULT 0,
    `group_id` int unsigned NOT NULL,
    FOREIGN KEY (`group_id`) REFERENCES `groups`(`id`) ON DELETE CASCADE,
    PRIMARY KEY (`id`),
    UNIQUE(`email`)
    -- Asumming one email per user
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
CREATE TABLE `employee_employees` (
    `id` int unsigned NOT NULL AUTO_INCREMENT,
    `employee_id` int unsigned NOT NULL ,
    `employee_subordinate_id` int unsigned NOT NULL ,
    PRIMARY KEY (`id`),
    FOREIGN KEY (`employee_id`) REFERENCES `employees`(`id`) ON DELETE CASCADE,
    FOREIGN KEY (`employee_subordinate_id`) REFERENCES `employees`(`id`) ON DELETE CASCADE
    -- Not unique relation, we're looking for a very flexible model
);
INSERT INTO `employees` (`name`, `surname`, `email`, `address`, `risk`, `group_id`) VALUES ('Mario', 'De la Torre', 'mario@delatorre.com', 'C/De Mario 34', 5, 1);
INSERT INTO `employees` (`name`, `surname`, `email`, `address`, `risk`, `group_id`) VALUES ('Juana', 'Martín', 'juana@martin.com', 'C/Alcalá 12', 3, 2);
INSERT INTO `employees` (`name`, `surname`, `email`, `address`, `risk`, `group_id`) VALUES ('Antonia', 'Fernández', 'antonia@fernandez.com', 'C/Mayor 98', 9, 2);
INSERT INTO `employee_employees` (`employee_id`, `employee_subordinate_id`) VALUES ('2', '3');
