DROP TABLE IF EXISTS `employee_employees`;
DROP TABLE IF EXISTS `employees`;
DROP TABLE IF EXISTS `group_groups`;
DROP TABLE IF EXISTS `groups`;
DROP TABLE IF EXISTS `companies`;
CREATE TABLE `companies` (
    `id` int unsigned NOT NULL AUTO_INCREMENT,
    `name` varchar(70) NOT NULL,
    `cif` varchar(200) DEFAULT NULL,
    `address` varchar(200) DEFAULT NULL,
    PRIMARY KEY (`id`),
    UNIQUE(`name`, `cif`)
    -- Asumming one CIF per company
);

INSERT INTO `companies` (`name`, `cif`, `address`) VALUES ('Compañía 1', 'CF123123', 'C/Falsa 123');
INSERT INTO `companies` (`name`, `cif`) VALUES ('Otra Compañía', 'CL98989');
