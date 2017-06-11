FROM nginx
RUN rm /etc/nginx/conf.d/default.conf
ADD conf/nginx.conf /etc/nginx/nginx.conf
ADD conf.d/smartfact.conf /etc/nginx/conf.d/smartfact.conf
