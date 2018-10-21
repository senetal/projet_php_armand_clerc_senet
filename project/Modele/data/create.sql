create table category(
  name varchar(32) primary key,
  category varchar(32),
  foreign key(category) references category(name)
);

create table user(

  name varchar(64) primary key,
  password varchar(64) not null,
  mail varchar(64) not null,
  tel varchar(10) not null,
  address varchar(256)
);

create table products(
  ref integer primary key,
  name varchar(64) not null,
  price float default 0.00,
  image varchar(16),
  description varchar(256),
  category varchar(32),
  owner varchar(64) ,
  foreign key(category) references category(name),
  foreign key(owner) references user(name)
);

create table panier(
  name varchar(64) ,
  ref integer ,
  count integer,
  foreign key(name) references user(name),
  foreign key(ref) references products(ref),
  primary key(name,ref)

);
