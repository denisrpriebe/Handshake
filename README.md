# Handshake

Handshake is a Magento 2 module that is designed to make the Magento 2 module development experience easier and more elegant. It does this by replacing the default Magento 2 ORM system with Laravel's Eloquent Library. Any custom Magento 2 module you build using Handshake can use Laravel style Migrations, Seeders, Models, Sessions and more with corresponding commands.

## Installation

Before you install Handshake, make sure you have a working copy of Magento 2. Also make sure that Magento 2 is properly configured as Handshake will try and use Magento 2's database configuration to run your migrations, seeds, etc.

You can install Handshake with composer:

    composer require irishtitan/handshake
    
After composer pulls in Handshake, you need to enable Handshake:

    php bin/magento module:enable IrishTitan_Handshake
    
Finish the installation by running:

    php bin/magento setup:upgrade
    php bin/magento handshake:install
    
If everything went smoothly, you are now ready to begin developing Magento 2 modules with Handshake.

## Usage

To see a list of Handshake commands run:

    php bin/magento
    
Scroll through the list until you see the Handshake section.

### Creating a New Module

To create a new Magento 2 module, you can use the `handshake:make:module` command:

    php bin/magento handshake:make:module Namespace Module
     
The `handshake:make:module` command accepts two arguments. `Namespace` is your vendor name and `Module` is the name of your module.

For example, `php bin/magento handshake:make:module Acme Forum`.

### Migrations

Once you have installed Handshake, a new directory will be created: `app/handshake`. This is where you may register your migrations and seeds. After creating a migration add it to `migrations.php`.
 
 To create a new migration, you can use the `handshake:make:migration` command:
 
    php bin/magento handshake:make:migration Namespace Module Migration
    
 The `handshake:make:migration` command accepts three arguments. `Namespace` is your vendor name, `Module` is the name of your module and `Migration` is the name of your migration.
 
 For example, `php bin/magento handshake:make:migration Acme Forum CreatePostsTable`
 
 All migrations are stored within the setup folder of your corresponding module.
 Once you have created your migration, you should register it within `app/handshake/migrations.php`.
 
 #### Running Your Migrations
 
 You can run your migrations with the `handshake:migrate` command.
 
 You can rollback your migrations with the `handshake:migrate:rollback` command.

## License

The Handshake Module is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT).
