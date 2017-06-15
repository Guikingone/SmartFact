FROM debian

ADD . /var/www/smartfact

RUN mkdir -p \
		var/cache \
		var/logs \
		var/sessions \
	&& chown -R www-data var

CMD ['/bin/true']
