drop database if exists todo;

create database todo;

use todo;

CREATE TABLE user (
    id int PRIMARY KEY auto_increment,
    username VARCHAR(30) not null UNIQUE,
    password varchar(255) not null,
    firstname varchar(100),
    lastname VARCHAR(100)
);

create TABLE task(
    id int primary key auto_increment,
    title varchar(255) not null,
    added timestamp default CURRENT_TIMESTAMP,
    description text,
    user_id int not null,
    index (user_id),
    foreign key (user_id) REFERENCES user(id)
    on delete RESTRICT
)