#!/bin/sh

echo "Renewing certs..."
docker run -it --rm \
  -v /home/ubuntu/ahichhatra/data/certs/letsencrypt/etc:/etc/letsencrypt \
  -p 80:80 deliverous/certbot renew --standalone

echo "Done"
