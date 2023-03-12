-----------------------------
-- users --------------------
-----------------------------

CREATE TABLE users (
  id integer primary key,
  password varchar(100),
  username varchar(50),
  firstname varchar(30),
  lastname varchar(30),
  gender varchar(10),
  address varchar(100),
  birth date,
  email varchar(40)
);

alter table users add constraint unique_username unique (username);

-----------------------------
-- perfumes -----------------
-----------------------------

CREATE TABLE products (
  id integer primary key,
  name varchar(150),
  manufacturer varchar(100),
  stock integer,
  new_price numeric(6,2),
  old_price numeric(6,2),
  quantity integer,
  category varchar(40),
  gender varchar(40),
  type varchar(40),
  info_url varchar(150),
  release_date date
);

CREATE TABLE sold (
  id_product integer,
  quantity_sold integer,
  purchase_date date,
  FOREIGN KEY (id_product) REFERENCES products(id)
);

CREATE TABLE cart (
  id_user integer,
  id_product integer,
  quantity integer,
  FOREIGN KEY (id_user) REFERENCES users(id),
  FOREIGN KEY (id_product) REFERENCES products(id)
);

CREATE TABLE favorites (
  id_user integer,
  id_product integer,
  FOREIGN KEY (id_user) REFERENCES users(id),
  FOREIGN KEY (id_product) REFERENCES products(id),
	 CONSTRAINT uniq_fav unique(id_user,id_product)
);


CREATE TABLE ingredients (
  id_product integer,
  name varchar(50),
  FOREIGN KEY (id_product) REFERENCES products(id)
);