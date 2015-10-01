Vagrant.configure("2") do |config|
    config.vm.provider :virtualbox do |v|
        v.name = "owncloud-provisioning.api"
        v.customize [
            "modifyvm", :id,
            "--name", "owncloud-provisioning.api",
            "--memory", 1024,
            "--cpus", 1,
        ]
    end

    config.vm.box = "ubuntu/trusty64"
    config.vm.hostname = "owncloud-provisioning.api"
    config.vm.network :private_network, ip: "192.168.15.15"
    config.ssh.forward_agent = true

    config.vm.synced_folder "./", "/vagrant", type: "nfs"
end