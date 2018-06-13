FROM php:7.0-apache

RUN apt-get update && \
	apt-get install -y vim

COPY apache2-foreground /usr/local/bin
COPY templates /var/apache2/templates
COPY conf/ /etc/apache2

RUN a2enmod proxy proxy_http
RUN a2ensite 000-* 001-*

#for load balancing
RUN a2enmod proxy_balancer status lbmethod_byrequests

#added for sticky sessions
RUN a2enmod headers

#docker build -t res/apache_rp .
#docker run -d -e STATIC_APP1=172.17.0.2:80 -e STATIC_APP2=172.17.0.3:80 -e DYNAMIC_APP1=172.17.0.4:3000 -e DYNAMIC_APP2=172.17.0.5:3000 -p 8080:80 res/apache_rp

