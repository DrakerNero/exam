#!/usr/bin/env bash
# Options
packages=$(echo "$1")
github_token=$(echo "$2")
swapsize=$(echo "$3")
# Helpers
#composer="hhvm -v ResourceLimit.SocketDefaultTimeout=30 -v Http.SlowQueryThreshold=30000 /usr/local/bin/composer"
composer="/usr/local/bin/composer"

# System configuration
if ! grep --quiet "swapfile" /etc/fstab; then
  fallocate -l ${swapsize}M /swapfile
  chmod 600 /swapfile
  mkswap /swapfile
  swapon /swapfile
  echo '/swapfile none swap defaults 0 0' >> /etc/fstab
fi

# Repositories mirror
if ! grep -q "mirrors.ubuntu.com" "/etc/apt/sources.list"; then
  sudo sed -i '' -e '1i\
  ## Mirror repositories \
  deb mirror://mirrors.ubuntu.com/mirrors.txt trusty main restricted universe multiverse \
  deb mirror://mirrors.ubuntu.com/mirrors.txt trusty-updates main restricted universe multiverse \
  deb mirror://mirrors.ubuntu.com/mirrors.txt trusty-backports main restricted universe multiverse \
  deb mirror://mirrors.ubuntu.com/mirrors.txt trusty-security main restricted universe multiverse \
  ' /etc/apt/sources.list
fi

# Additional repositories
if [ ! -f /etc/apt/sources.list.d/hhvm.list ]; then
    sudo apt-key adv --recv-keys --keyserver hkp://keyserver.ubuntu.com:80 0x5a16e7281be7a449
    sudo echo 'deb http://dl.hhvm.com/ubuntu trusty main' >> /etc/apt/sources.list.d/hhvm.list
fi

# Configuring server software
sudo update-locale LC_ALL="C"
sudo dpkg-reconfigure locales
echo "mysql-server-5.6 mysql-server/root_password password root" | debconf-set-selections
echo "mysql-server-5.6 mysql-server/root_password_again password root" | debconf-set-selections

sudo apt-get update
sudo apt-get upgrade -y
sudo apt-get install -y ${packages}

sudo php5enmod mcrypt
sudo sed -i 's/bind-address.*/bind-address = 0.0.0.0/g' /etc/mysql/my.cnf;
if ! grep --quiet '^xdebug.remote_enable = on$' /etc/php5/mods-available/xdebug.ini; then
    (
     echo "xdebug.remote_enable = on";
     echo "xdebug.remote_connect_back = on";
     echo "xdebug.remote_host = 10.0.2.2";
     echo "xdebug.idekey = \"vagrant\""
    ) >> /etc/php5/mods-available/xdebug.ini
fi

# install composer
${composer} config --global github-oauth.github.com ${github_token}
if [ ! -f /usr/local/bin/composer ]; then
	sudo curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
    ${composer} global require fxp/composer-asset-plugin --prefer-dist
else
	${composer} self-update
	${composer} global update --prefer-dist
fi

# init application
if [ ! -d /var/www/vendor ]; then
    cd /var/www && ${composer} install --prefer-dist --optimize-autoloader
else
    cd /var/www && ${composer} update --prefer-dist --optimize-autoloader
fi

cp /var/www/.env.dist /var/www/.env
cp /var/www/tests/.env.dist /var/www/tests/.env

# install adminer
if [ ! -d /usr/share/adminer ]; then
  sudo mkdir /usr/share/adminer -p
  sudo wget "http://www.adminer.org/latest.php" -O /usr/share/adminer/latest.php
  sudo ln -s /usr/share/adminer/latest.php /usr/share/adminer/index.php
fi

# create nginx config
if [ ! -f /etc/nginx/sites-enabled/epretest2.dev ]; then
    cp /var/www/vhost.conf.dist /var/www/vhost.conf
    sudo ln -s /var/www/vhost.conf /etc/nginx/sites-enabled/epretest2.dev
fi

# Configuring application
echo "GRANT ALL PRIVILEGES ON *.* TO 'root'@'%' IDENTIFIED BY 'root'" | mysql -uroot -proot
echo "FLUSH PRIVILEGES" | mysql -uroot -proot
echo "CREATE DATABASE IF NOT EXISTS \`epretest2\` CHARACTER SET utf8 COLLATE utf8_unicode_ci" | mysql -uroot -proot
echo "CREATE DATABASE IF NOT EXISTS \`epretest2-test\` CHARACTER SET utf8 COLLATE utf8_unicode_ci" | mysql -uroot -proot

# Set permission and migrate db
php /var/www/console/yii app/setup
php /var/www/console/yii migrate/up --interactive=0
php /var/www/console/yii rbac-migrate/up --interactive=0

# Migrate test db
php /var/www/tests/codeception/bin/yii migrate/up --interactive=0
php /var/www/tests/codeception/bin/yii rbac-migrate/up --interactive=0

sudo service mysql restart
sudo service php5-fpm restart
sudo service nginx restart
