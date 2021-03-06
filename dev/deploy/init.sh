#!/bin/bash

echo "Creating configuration files"
cp .wpengine/config/staging.cfg.sample .wpengine/config/staging.cfg
cp .wpengine/config/production.cfg.sample .wpengine/config/production.cfg
cp .wpengine/config/common.cfg.sample .wpengine/config/common.cfg

PASSWORD=$(LC_ALL=C tr -dc 'A-Za-z0-9!"#$%&'\''()*+,-./:;<=>?@[\]^_`{|}~' </dev/urandom | head -c 13)
echo $PASSWORD > .wpengine/ansible_rsa_password

ssh-keygen -t rsa -b 4096 -N "$PASSWORD" -f .wpengine/ansible_rsa -C "servers@tri.be"

echo "Encrypting files"
source encrypt.sh

echo "Setup complete. Edit the .cfg files in the .wpengine/config directory and run encrypt.sh."