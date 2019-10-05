DROP TABLE IF EXISTS `employees`;
CREATE TABLE `employees` (
    `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
    `name` varchar(70) NOT NULL,
    `surname` varchar(100) DEFAULT NULL,
    `email` varchar(70) NOT NULL,
    `address` varchar(200) DEFAULT NULL,
    PRIMARY KEY (`id`),
    UNIQUE(`email`)
    -- Asumming one email per user
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
DROP TABLE IF EXISTS `employee_employees`;
CREATE TABLE `employee_employees` (
    `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
    `employee`,
    `employee_subordinate`,
    PRIMARY KEY (`id`),
    -- Not unique relation, we're looking for a very flexible model
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `users` (`name`, `email`) VALUES ('Phalcon Team', 'team@phalconphp.com');
