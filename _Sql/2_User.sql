CREATE USER 'user'@'%' IDENTIFIED WITH mysql_native_password AS 'pass';
GRANT USAGE ON *.* TO 'user'@'%' REQUIRE NONE WITH MAX_QUERIES_PER_HOUR 0 MAX_CONNECTIONS_PER_HOUR 0 MAX_UPDATES_PER_HOUR 0 MAX_USER_CONNECTIONS 0;
GRANT SELECT, INSERT, UPDATE ON  `example`.* TO 'user'@'%';