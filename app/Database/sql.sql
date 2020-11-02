drop database if exists todo;

create database todo;

use todo;

create TABLE task(
    id int primary key auto_increment,
    title varchar(255) not null,
    added timestamp default CURRENT_TIMESTAMP,
    description text
)