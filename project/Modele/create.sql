create table category(
  name varchar(32) primary key,
  category varchar(32),
  foreign key(category) references category(name)
);

create table products(
  ref integer primary key,
  name varchar(64) not null,
  price float default 0.00,
  image varchar(16),
  description varchar(256),
  category varchar(32),
  address varchar(32),
  foreign key(category) references category(name)
);
create table user(

  id integer primary key,
  name varchar(64) not null,
  password varchar(64) not null,
  mail varchar(64) not null
);
