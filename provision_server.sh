#!/bin/bash

# Exit on error
set -e

echo "--- Updating System ---"
apt-get update
apt-get upgrade -y

echo "--- Installing Nginx ---"
apt-get install -y nginx

echo "--- Installing PHP 8.2 and Extensions ---"
# Add repository for PHP 8.2 if needed (standard on Ubuntu 24.04 but good specificy)
apt-get install -y software-properties-common
add-apt-repository -y ppa:ondrej/php
apt-get update

apt-get install -y php8.2 php8.2-fpm php8.2-mysql php8.2-mbstring php8.2-xml php8.2-bcmath php8.2-curl php8.2-zip php8.2-intl php8.2-gd php8.2-soap php8.2-sqlite3

echo "--- Installing Composer ---"
curl -sS https://getcomposer.org/installer | php
mv composer.phar /usr/local/bin/composer

echo "--- Configuring Nginx ---"
# Remove default site
rm -f /etc/nginx/sites-enabled/default

# Create new site config
cat > /etc/nginx/sites-available/petmart2 << 'EOF'
server {
    listen 80;
    server_name _;
    root /var/www/petmart2/public;

    add_header X-Frame-Options "SAMEORIGIN";
    add_header X-Content-Type-Options "nosniff";

    index index.php;

    charset utf-8;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location = /favicon.ico { access_log off; log_not_found off; }
    location = /robots.txt  { access_log off; log_not_found off; }

    error_page 404 /index.php;

    location ~ \.php$ {
        fastcgi_pass unix:/var/run/php/php8.2-fpm.sock;
        fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
        include fastcgi_params;
    }

    location ~ /\.(?!well-known).* {
        deny all;
    }
}
EOF

# Enable site
ln -s /etc/nginx/sites-available/petmart2 /etc/nginx/sites-enabled/

echo "--- Setting Permissions ---"
# Create directory if it doesn't exist
mkdir -p /var/www/petmart2
# Set ownership to current user (ubuntu) temporarily for deployment, 
# but usually www-data needs access. We'll set www-data as group.
chown -R ubuntu:www-data /var/www/petmart2
chmod -R 775 /var/www/petmart2

echo "--- Restarting Services ---"
systemctl restart php8.2-fpm
systemctl restart nginx

echo "--- PROVISIONING COMPLETE ---"
echo "You can now run the deployment script."
