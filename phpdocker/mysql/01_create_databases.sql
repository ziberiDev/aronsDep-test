# create databases
CREATE DATABASE IF NOT EXISTS `arons_department`;


# create users and grant rights
CREATE USER 'denis'@'%' IDENTIFIED BY 'denis';
GRANT ALL ON arons_department.* TO 'denis'@'%';

