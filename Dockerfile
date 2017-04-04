## upgrade the image to use xdebug ##

FROM silintl/php7
MAINTAINER arnoult marc

RUN apt-get update && apt-get install -y php-xdebug


EXPOSE 80
CMD ["apache2ctl", "-D", "FOREGROUND"]