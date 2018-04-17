drop database if exists         SportsTeam;
create database                 SportsTeam;

DROP USER IF EXISTS "root";
GRANT SELECT, INSERT, DELETE, UPDATE ON *.* TO 'root'@'localhost';

USE SportsTeam;

CREATE TABLE userRole (
    userID int(11) NOT NULL AUTO_INCREMENT,
    email VARCHAR(100),
    password varchar(100),
    DBS_Administrator TINYINT(1),
    Executive_Manager TINYINT(1),
    USERS TINYINT(1),
    OBSERVER TINYINT(1)
);

CREATE TABLE UserLogin
(
    ID            INT(10)          UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    Name_First    VARCHAR(100),
    Name_Last     VARCHAR(150)     NOT NULL,
    Email         VARCHAR(250),
    UserName      VARCHAR(100),
    Password      VARCHAR(100),
    Role          VARCHAR(100)
);