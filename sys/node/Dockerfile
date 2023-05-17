FROM ubuntu

MAINTAINER Luyanda Siko sikoluyanda@gmail.com

ARG DEBIAN_FRONTEND=noninteractive
RUN apt-get update
RUN apt-get upgrade -y
RUN apt-get install apache2 -y
RUN apt-get clean

WORKDIR /var/www/html/app

# Copy the application code
COPY . /var/www/html/app

ENV APACHE_DOCUMENT_ROOT=/var/www/html/app/public

RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

EXPOSE 80

CMD ["apache2ctl","-D","FOREGROUND"]