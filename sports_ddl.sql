drop database if exists         SportsTeam;
create database                 SportsTeam;

DROP USER IF EXISTS "root";
GRANT SELECT, INSERT, DELETE, UPDATE ON *.* TO 'root'@'localhost';

USE SportsTeam;

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

CREATE TABLE LeagueTeam
( TeamID      INTEGER UNSIGNED NOT NULL AUTO_INCREMENT  PRIMARY KEY,
  TeamName    VARCHAR(100),
  TeamCoach   VARCHAR(100)
);


INSERT INTO LeagueTeam VALUES
('1','CSUF Titans', 'Deadpool'),
('2','UCI AntEaters','Batman'),
('3','CSULB Wildcats','Daredevil'),
('4','UCR GreenHornets','Hulk'),
('5','UCSD Bees','Cerci Lannister'),
('6','UCLA Bruins','Morgan Freeman'),
('7','CSUSB Wolfs','Joker'),
('8','CSULA Eagles','Vin Diesel');

CREATE TABLE GP_TeamA
(
TeamID_A  INTEGER UNSIGNED  NOT NULL,
GameRound INTEGER    UNSIGNED  NOT NULL,
TeamAPoints   VARCHAR(100),
FOREIGN KEY (TeamID_A) REFERENCES LeagueTeam(TeamID) ON DELETE CASCADE
);

INSERT INTO GP_TeamA VALUES
('1','1','50'),
('3','1','40'),
('5','1','70'),
('7','1','55'),
('1','2','70'),
('6','2','50'),
('1','3','20');

CREATE TABLE GP_TeamB
(
TeamID_B INTEGER UNSIGNED NOT NULL,
GameRound INTEGER    UNSIGNED  NOT NULL,
TeamBPoints VARCHAR(100),
FOREIGN KEY (TeamID_B) REFERENCES LeagueTeam(TeamID) ON DELETE CASCADE
);

   
INSERT INTO GP_TeamB VALUES
('2','1','20'),
('4','1','35'),
('6','1','20'),
('8','1','25'),
('4','2','35'),
('7','2','30'),
('6','3','15');


CREATE TABLE TeamRoster
( ID            INTEGER UNSIGNED  NOT NULL    AUTO_INCREMENT  PRIMARY KEY,
  Name_First    VARCHAR(100),
  Name_Last     VARCHAR(150)      NOT NULL,
  Street        VARCHAR(250),
  City          VARCHAR(100),
  State         VARCHAR(100),
  Country       VARCHAR(100),
  ZipCode       CHAR(10),

  CHECK (ZipCode REGEXP '(?!0{5})(?!9{5})\\d{5}(-(?!0{4})(?!9{4})\\d{4})?'),
  
  INDEX  (Name_Last),
  UNIQUE (Name_Last, Name_First)
);

INSERT INTO TeamRoster VALUES
('100', 'Donald',               'Duck',    '1313 S. Harbor Blvd.',    'Anaheim',            'CA',            'USA',     '92808-3232'),
('101', 'Daisy',                'Duck',    '1180 Seven Seas Dr.',     'Lake Buena Vista',   'FL',            'USA',     '32830'),
('102', 'Mickey',               'Mouse',   '1313 S. Harbor Blvd.',    'Anaheim',            'CA',            'USA',     '92808-3232'),
('103', 'Pluto',                'Dog',     '1313 S. Harbor Blvd.',    'Anaheim',            'CA',            'USA',     '92808-3232'),

('104', 'Scrooge',              'McDuck',  '1180 Seven Seas Dr.',     'Lake Buena Vista',   'FL',            'USA',     '32830'),
('105', 'Huebert (Huey)',       'Duck',    '1110 Seven Seas Dr.',     'Lake Buena Vista',   'FL',            'USA',     '32830'),
('106', 'Deuteronomy (Dewey)',  'Duck',    '1110 Seven Seas Dr.',     'Lake Buena Vista',   'FL',            'USA',     '32830'),
('107', 'Louie',                'Duck',    '1110 Seven Seas Dr.',     'Lake Buena Vista',   'FL',            'USA',     '32830'),
('108', 'Phooey',               'Duck',    '1-1 Maihama Urayasu',     'Chiba Prefecture',   'Disney Tokyo',  'Japan',   NULL),

('109', 'Della',                'Duck',    '77700 Boulevard du Parc', 'Coupvray',           'Disney Paris',  'France',  NULL);



CREATE TABLE Statistics
(
  ID                INTEGER    UNSIGNED  NOT NULL  AUTO_INCREMENT PRIMARY KEY,
  Player            INTEGER    UNSIGNED  NOT NULL,
  PlayingTimeMin    TINYINT(2) UNSIGNED  DEFAULT 0 COMMENT 'Two 20-minute halves',
  PlayingTimeSec    TINYINT(2) UNSIGNED  DEFAULT 0,
  Points            TINYINT    UNSIGNED  DEFAULT 0,
  Assists           TINYINT    UNSIGNED  DEFAULT 0,
  Rebounds          TINYINT    UNSIGNED  DEFAULT 0,

  FOREIGN KEY (Player) REFERENCES TeamRoster(ID) ON DELETE CASCADE,

  CHECK((PlayingTimeMin < 40 AND PlayingTimeSec < 60) OR 
        (PlayingTimeMin = 40 AND PlayingTimeSec = 0 ))
);

INSERT INTO Statistics VALUES
('17', '100', '35', '12', '47', '11', '21'),
('18', '102', '13', '22', '13', '01', '03'),
('19', '103', '10', '00', '18', '02', '04'),
('20', '107', '02', '45', '09', '01', '02'),
('21', '102', '15', '39', '26', '03', '07'),
('22', '100', '29', '47', '27', '09', '08');