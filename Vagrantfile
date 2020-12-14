Vagrant.configure("2") do |config|
	config.vm.box = "centos/7"
	config.vm.network "forwarded_port", guest: 8080, host: 80, host_ip: "127.0.0.1"
	config.vm.provider "virtualbox" do |v|
		v.name = "highload_project"
		v.memory = "2048"
	end
end