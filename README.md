# FileNameExtension
magento 2.1 module that adds a field 'file_name' on orders


install : 
composer require "ethos/filenameextension:*"

php bin/magento setup:upgrade

uninstall : 
php bin/magento module:uninstall Ethos_FileNameExtension --remove-data

The option --remove-data is supposed to call the uninstall method of the Uninstall class of the module, 
which has to inherit from \Magento\Framework\Setup\UninstallInterface.

The truth is, magento module:uninstall is kinf od stuck, it never ends and never do te job properly, the only things done are : 
composer.json : remove the module from require section.
database : remove module from table setup_module.

the code is still in vendor, and the data in db... Fuck this.
