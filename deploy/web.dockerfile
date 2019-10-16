FROM nginx:1.16-alpine

ADD deploy/vhost.conf /etc/nginx/conf.d/default.conf

COPY public /var/www/public

RUN chown -R nginx:nginx /var/www/public
