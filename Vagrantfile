VAGRANTFILE_API_VERSION = "2"

Vagrant.configure(VAGRANTFILE_API_VERSION) do |config|
  config.vm.box = "precise64"
  config.vm.box_url = "http://files.vagrantup.com/precise64.box"

  config.vm.network :private_network, ip: "192.168.100.200"

  config.ssh.forward_agent = true

  config.vm.synced_folder "./public", "/var/www/phpansible.dev", id: "vagrant-root", :nfs => false

  config.vm.provider :virtualbox do |vb|
    vb.customize [
       "modifyvm", :id,
       "--name", "Phpansible",
       "--memory", 512,
       "--natdnshostresolver1", "on"
    ]
  end

  config.vm.provision :ansible do |ab|
    ab.playbook = "vagrant/webserver.yml"
  end
end
