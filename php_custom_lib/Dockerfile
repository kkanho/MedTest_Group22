FROM php:8.1.1-apache
RUN docker-php-ext-install pdo pdo_mysql
# RUN docker-php-ext-install mysqli && docker-php-ext-enable mysqli

# FROM mysql:latest
# CMD ["RUN mysql -h localhost -P 3306 -u root", "RUN GRANT ALL PRIVILEGES ON mysql.general_log TO 'admin';", "RUN FLUSH PRIVILEGES;", "RUN exit;"]

# RUN mysql -h localhost -P 3306 -u root
# RUN GRANT ALL PRIVILEGES ON mysql.general_log TO 'admin';
# RUN FLUSH PRIVILEGES;
# RUN exit;