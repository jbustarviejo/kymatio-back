DROP TABLE IF EXISTS `group_groups`;
DROP TABLE IF EXISTS `groups`;
CREATE TABLE `groups` (
    `id` int unsigned NOT NULL AUTO_INCREMENT,
    `type` varchar(70) NOT NULL,
    `name` varchar(70) DEFAULT NULL,
    `company_id` int unsigned NOT NULL,
    FOREIGN KEY (`company_id`) REFERENCES `companies`(`id`) ON DELETE CASCADE,
    PRIMARY KEY (`id`)
);
CREATE TABLE `group_groups` (
    `id` int unsigned NOT NULL AUTO_INCREMENT,
    `group_id` int unsigned NOT NULL ,
    `group_subordinate_id` int unsigned NOT NULL ,
    PRIMARY KEY (`id`),
    FOREIGN KEY (`group_id`) REFERENCES `groups`(`id`) ON DELETE CASCADE,
    FOREIGN KEY (`group_subordinate_id`) REFERENCES `groups`(`id`) ON DELETE CASCADE
    -- Not unique relation, we're looking for a very flexible model
);

INSERT INTO `groups` (`type`, `name`, `company_id`) VALUES ('Departamento', 'Finanzas',1);
INSERT INTO `groups` (`type`, `name`, `company_id`) VALUES ('Departamento', 'Contabilidad',1);
INSERT INTO `groups` (`type`, `name`, `company_id`) VALUES ('Area', 'Financiera',1);
INSERT INTO `group_groups` (`group_id`, `group_subordinate_id`) VALUES ('1', '3');
INSERT INTO `group_groups` (`group_id`, `group_subordinate_id`) VALUES ('2', '3');
