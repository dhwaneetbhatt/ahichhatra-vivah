#!/bin/sh

echo "Getting certificates..."
docker run -it --rm \
  -v /home/ubuntu/ahichhatra/data/certs/letsencrypt/etc:/etc/letsencrypt \
  -p 80:80 deliverous/certbot certonly --standalone -d vivah.ahichhatra.org

echo "Updating Latest cert for cURL"
wget https://curl.haxx.se/ca/cacert.pem
mv cacert.pem vendor/guzzlehttp/guzzle/src/

echo "Done"
