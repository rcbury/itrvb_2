PRAGMA foreign_keys=OFF;
BEGIN TRANSACTION;
CREATE TABLE articles (uuid TEXT PRIMARY KEY, author_uuid TEXT REFERENCES users (uuid), article TEXT, content TEXT);
CREATE TABLE comments (uuid TEXT PRIMARY KEY, article_uuid TEXT REFERENCES articles (uuid), author_uuid TEXT REFERENCES users (uuid), content TEXT);
CREATE TABLE users (uuid TEXT PRIMARY KEY, first_name TEXT, last_name TEXT, username TEXT);
COMMIT;
