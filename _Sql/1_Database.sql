CREATE DATABASE IF NOT EXISTS example;

\c example;

CREATE TABLE IF NOT EXISTS users (

  id serial PRIMARY KEY,
  firstname varchar(255) NOT NULL,
  lastname varchar(255) NOT NULL,
  created timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP

);

create user exampleuser;

alter database example owner to exampleuser;
alter table users owner to exampleuser;


--grant all privileges on database example to exampleuser;
--grant all privileges on table users to exampleuser;