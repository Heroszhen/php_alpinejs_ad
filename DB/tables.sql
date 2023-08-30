--
-- File generated with SQLiteStudio v3.4.4 on ÖÜ¶þ 8ÔÂ 15 16:12:08 2023
--
-- Text encoding used: System
--
PRAGMA foreign_keys = off;
BEGIN TRANSACTION;

-- Table: article
CREATE TABLE IF NOT EXISTS article (id INTEGER PRIMARY KEY AUTOINCREMENT, title VARCHAR (255) DEFAULT '', poster text DEFAULT '', description text DEFAULT '', user_id INTEGER NOT NULL, created datetime DEFAULT CURRENT_TIMESTAMP, filter varchar (10) DEFAULT (''), FOREIGN KEY (user_id) REFERENCES user (id));

-- Table: photo
CREATE TABLE IF NOT EXISTS photo (id INTEGER PRIMARY KEY AUTOINCREMENT, url text DEFAULT '', user_id INTEGER NOT NULL, created datetime DEFAULT CURRENT_TIMESTAMP, filter varchar (5) DEFAULT "", FOREIGN KEY (user_id) REFERENCES user (id));

-- Table: user
CREATE TABLE IF NOT EXISTS user (id INTEGER PRIMARY KEY AUTOINCREMENT, email VARCHAR (50) DEFAULT '', password VARCHAR (255) DEFAULT '', lastname VARCHAR (50) DEFAULT '', firstname VARCHAR (50) DEFAULT '', roles text DEFAULT '', created datetime DEFAULT CURRENT_TIMESTAMP, photo TEXT DEFAULT "", filter TEXT (10) DEFAULT "");

-- Table: video
CREATE TABLE IF NOT EXISTS video (id INTEGER PRIMARY KEY AUTOINCREMENT, type INTEGER NOT NULL, url text DEFAULT '', user_id INTEGER NOT NULL, created datetime DEFAULT CURRENT_TIMESTAMP, filter varchar (10) DEFAULT (''), thumbnail TEXT DEFAULT (''), title varchar (255) DEFAULT (''), FOREIGN KEY (user_id) REFERENCES user (id));

COMMIT TRANSACTION;
PRAGMA foreign_keys = on;
