VAGRANTFILE_API_VERSION = '2'

@script = <<SCRIPT
    apt-get update
    apt-get install -y apache2 git curl php5-cli php5 php5-intl libapache2-mod-php5 php5-dev php-pear
    pecl install xdebug

    echo 'zend_extension=xdebug.so' >> /etc/php5/cli/php.ini
    echo 'zend_extension=xdebug.so' >> /etc/php5/apache2/php.ini
    echo -e 'xdebug.remote_enable = on\nxdebug.remote_connect_back = on\nxdebug.idekey = "vagrant"' >> /etc/php5/apache2/php.ini
    echo -e 'xdebug.remote_enable = on\nxdebug.remote_connect_back = on\nxdebug.idekey = "vagrant"' >> /etc/php5/cli/php.ini

    a2enmod rewrite
    service apache2 restart
    cd /var/www/laravel
    curl -Ss https://getcomposer.org/installer | php
    usermod -a -G www-data vagrant
    rm -rf /var/www/html
    ln -s /var/www/laravel/public/ /var/www/html
    cd /var/www/laravel
    sudo php composer.phar install -o
    sudo cp .env.example .env
    sudo php artisan key:generate
SCRIPT

Vagrant.configure(VAGRANTFILE_API_VERSION) do |config|
  config.vm.box = 'ubuntu/vivid64'
  config.vm.network "forwarded_port", guest: 80, host: 8085
  config.vm.synced_folder './laravel', '/var/www/laravel', owner: 'www-data', group: 'www-data'
  config.vm.provision 'shell', inline: @script

  config.vm.provider "virtualbox" do |vb|
    vb.customize ["modifyvm", :id, "--memory", "1024"]
  end

end
