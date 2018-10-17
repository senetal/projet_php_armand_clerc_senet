create table category()
  name varchar(32),
  category varchar(32) reference category(name)
);

create table products()
  ref integer primary key,
  name varchar(64) not null,
  price float default 0.00,
  image varchar(16),
  description varchar(256),
  category varchar(32) reference category(name)
);
