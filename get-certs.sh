#!/bin/sh

docker pull palobo/certbot

GetCert() {
        docker run -it \
                --rm \
                -v /home/ubuntu/ahichhatra/data/certs/letsencrypt/etc:/etc/letsencrypt \
                -v /home/ubuntu/ahichhatra/data/certs/letsencrypt/lib:/var/lib/letsencrypt \
                -v /home/ubuntu/ahichhatra/data/certs/letsencrypt/www:/var/www/.well-known \
                palobo/certbot -t certonly --webroot -w /var/www \
                --keep-until-expiring \
                $@
}

echo "Getting certificates..."
GetCert -d vivah.ahichhatra.org

echo "Updating Latest cert for cURL"
wget https://curl.haxx.se/ca/cacert.pem
mv cacert.pem vendor/guzzlehttp/guzzle/src/

echo "Done"
