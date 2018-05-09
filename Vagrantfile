# -*- mode: ruby -*-
# vi: set ft=ruby :
#
# WPDistillery Vagrantfile using Scotch Box
#
# File Version: 1.0

Vagrant.configure("2") do |config|

    config.vm.box = "scotch/box"
    config.vm.network "private_network", ip: "192.168.10.99"
    config.vm.hostname = "jk-architektura.pl"

    # Windows Support
    if Vagrant::Util::Platform.windows?
      config.vm.provision "shell",
      inline: "echo \"Converting Files for Windows\" && sudo apt-get install -y dos2unix && cd /var/www/ && dos2unix wpdistillery/config.yml && dos2unix wpdistillery/provision.sh && dos2unix wpdistillery/wpdistillery.sh && dos2unix mysqldump.sh",
      run: "always", privileged: false
    end

    # Run Provisioning – executed within the first `vagrant up` and every `vagrant provision`
    config.vm.provision "shell", path: "wpdistillery/provision.sh"

    # OPTIONAL - Update WordPress and all Plugins on vagrant up – executed within every `vagrant up`
    #config.vm.provision "shell", inline: "echo \"== Update WordPress & Plugins ==\" && cd /var/www/public && wp core update && wp plugin update --all", run: "always", privileged: false

    # OPTIONAL - Enable NFS. Make sure to remove line 13 (See https://stefanwrobel.com/how-to-make-vagrant-performance-not-suck)
    config.vm.synced_folder ".", "/var/www", :nfs => { :mount_options => ["dmode=777","fmode=666"] }

    # DEV THEME MOUNT
    config.vm.synced_folder "./dist/themes/jk-architektura", "/var/www/public/wp-content/themes/jk-architektura", :nfs => { :mount_options => ["dmode=777","fmode=666"] }

    # DUMP DB ON HALT
    config.trigger.before :halt do
      if File.exist?( File.dirname(__FILE__) + '/mysqldump.sh' )
        info 'Dumping DB'
        run_remote "bash /var/www/mysqldump.sh"
      end
    end
end
