--Postgres

CREATE TABLE rewrite (
    id serial primary key,
    original_url character varying(500) not null unique,
    short_slug character varying(20)
);

--Mysql
--CREATE TABLE rewrite (
--  id int(10) primary key auto_increment,
--  original_url varchar(500) not null unique,
--  short_slug varchar(20)
--);