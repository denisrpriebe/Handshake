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
    
If everything went smoothly, you are now ready to begin developing Magento 2 modules with Handshake.

## Products

When working with Magento 2 products, you may use the `IrishTitan\Handshake\Facades\Product` facade to perform a number of different actions. For example:

To find a product by it's ID use the `find` method:

    $product = Product::find(23);
    
To find a product by it's SKU use the `whereSku` method:

    $product = Product::whereSku('PROD0001');
    
To get all products in the Magento 2 catalog use the `all` method:

    $products = Product::all();
    
To add an image to a product use the `addImage` method:

    $product = Product::find(123);
    $product->addImage('path/to/first/image.jpg');
    $product->addImage('path/to/second/image.jpg');
    
Alternatively, you may also do this as all Handshake methods are chain-able:

    Product::find(123)
        ->addImage('path/to/first/image.jpg')
        ->addImage('path/to/second/image.jpg');
    
To get an array of all the images a product has use the `images` method:

    $product = Product::whereSku('PROD0002');
    $images = $product->images();
    
To get all the categories a products is in use the `categories` method:

    $product = Product::find(487);
    $categories = $product->categories();
    
To create a new product you may use the `create` method:

    $bmw = Product::create([
        'name' => 'BMW',
        'sku' => 'BMW0001',
        'url_key' => 'bmw0001',
        'price' => 65000
    ]);
    
To assign a category to a product us the `assignToCategory` method:

    
  
In the above examples, `whereSku` and `find` both return an instance of `IrishTitan\Handshake\Core\Catalog\Product`. Please check out this class to get a better understanding of how things work.


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
