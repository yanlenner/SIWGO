GRANT ALL PRIVILEGES ON *.* TO 'usuario'@'localhost' IDENTIFIED BY 'password' REQUIRE NONE WITH GRANT OPTION MAX_QUERIES_PER_HOUR 0 MAX_CONNECTIONS_PER_HOUR 0 MAX_UPDATES_PER_HOUR 0 MAX_USER_CONNECTIONS 0;

CREATE USER 'odontologia'@'localhost' IDENTIFIED BY 'proyectoii';
GRANT USAGE ON *.* TO 'odontologia'@'localhost' REQUIRE NONE WITH MAX_QUERIES_PER_HOUR 0 MAX_CONNECTIONS_PER_HOUR 0 MAX_UPDATES_PER_HOUR 0 MAX_USER_CONNECTIONS 0;

GRANT ALL PRIVILEGES ON `odontologia`.* TO 'odontologia'@'localhost';
GRANT ALL PRIVILEGES ON `test`.* TO 'odontologia'@'localhost';

#$cfg['Servers'][$i]['hide_db'] = 'information_schema'; /etc/phpmyadmin/config.inc.php
