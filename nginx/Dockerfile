FROM nginx
RUN rm /etc/nginx/conf.d/default.conf
ADD conf/core/nginx.conf /etc/nginx/nginx.conf
ADD conf/app/smartfact.conf /etc/nginx/conf.d/smartfact.conf
