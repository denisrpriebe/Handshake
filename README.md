# Handshake

Handshake is a Magento 2 module that is designed to make the Magento 2 module development experience easier and more elegant. It does this by replacing the default Magento 2 ORM system with Laravel's Eloquent Library. Any custom Magento 2 module you build using Handshake can use Laravel style Migrations, Seeders, Models, Sessions and more with corresponding commands.

## Installation

Before you install Handshake, make sure you have a working copy of Magento 2. Also make sure that Magento 2 is properly configured as Handshake will try and use Magento 2's database configuration to run your migrations, seeds, etc.

You can install Handshake with composer:

    composer require irishtitan/handshake
    
After composer pulls in Handshake, you need to enable Handshake:

    php bin/magento module:enable IrishTitan_Handshake
    
Finish the installation by running:

    php bin/magento handshake:install
    
If everything went smoothly, you are now ready to begin developing Magento 2 modules with Handshake.

## Usage

To see a list of Handshake commands run:

    php bin/magento
    
Scroll through the list until you see the Handshake section.

#### Creating a New Module

To create a new Magento 2 module, you can use the `handshake:make:module` command:

    php bin/magento handshake:make:module Namespace Module
     
The `handshake:make:module` command accepts two arguments. `Namespace` is your vendor name and `Module` is the name of your module.

For example, `php bin/magento handshake:make:module Acme Forum`.

#### Migrations

## License

The Handshake Module is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT).