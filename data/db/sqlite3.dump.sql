BEGIN TRANSACTION;
CREATE TABLE customers (
  id INTEGER PRIMARY KEY,
  firstname varchar(64) NOT NULL,
  lastname varchar(64) NOT NULL,
  address text NOT NULL,
  country INTEGER NOT NULL DEFAULT '1'
);
COMMIT;
