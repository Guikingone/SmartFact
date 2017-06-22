FROM debian

ENV WORKDIR "/var/www/smartact"

ADD . ${WORKDIR}

RUN ls -l ${WORKDIR}

RUN mkdir -p \
		${WORKDIR}/var/cache \
		${WORKDIR}/var/logs \
		${WORKDIR}/var/sessions \
	&& chown -R www-data ${WORKDIR}/var

RUN apt-get update -y && apt-get upgrade -y \
    && apt-get install varnish -y

CMD ['/bin/true']
