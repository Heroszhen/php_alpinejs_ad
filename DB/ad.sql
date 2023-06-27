CREATE TABLE IF NOT EXISTS user(
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    email VARCHAR(50) DEFAULT '',
    password VARCHAR(255) DEFAULT '',
    lastname VARCHAR(50) DEFAULT '',
    firstname VARCHAR(50) DEFAULT '',
    roles text DEFAULT '',
    created datetime default CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS photo(
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    url text DEFAULT '',
    user_id INTEGER NOT NULL,
    created datetime default CURRENT_TIMESTAMP,
    FOREIGN KEY(user_id) REFERENCES user(id)
);

--type: 1-iframe, 2-src(video), 3-external url
CREATE TABLE IF NOT EXISTS video(
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    type INTEGER NOT NULL,
    url text DEFAULT '',
    user_id INTEGER NOT NULL,
    created datetime default CURRENT_TIMESTAMP,
    FOREIGN KEY(user_id) REFERENCES user(id)
);

CREATE TABLE IF NOT EXISTS movie(
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    title VARCHAR(255) DEFAULT '',
    poster text DEFAULT '',
    description text DEFAULT '',
    starring text DEFAULT '',
    release_date datetime NOT NULL,
    running_time INTEGER NOT NULL,
    user_id INTEGER NOT NULL,
    created datetime default CURRENT_TIMESTAMP,
    FOREIGN KEY(user_id) REFERENCES user(id)
);

CREATE TABLE IF NOT EXISTS article(
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    title VARCHAR(255) DEFAULT '',
    poster text DEFAULT '',
    description text DEFAULT '',
    user_id INTEGER NOT NULL,
    created datetime default CURRENT_TIMESTAMP,
    FOREIGN KEY(user_id) REFERENCES user(id)
);