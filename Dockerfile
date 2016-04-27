FROM php:apache
# debian:jessie, apache on port 80, php:latest
# retrieve needed system programs
RUN apt-get update && apt-get upgrade -y sendmail && apt-get upgrade -y rsyslog && rm -rf /var/lib/apt/lists/*
# to be ran later
COPY ./config_files/mail_config.sh /var/www
# php:apache recommends using your own php.ini
COPY ./config_files/php.ini /usr/local/etc/php/php.ini
RUN chmod 777 /var/www/mail_config.sh
CMD ["/var/www/mail_config.sh", "-n"]