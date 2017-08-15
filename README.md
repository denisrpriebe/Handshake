# Handshake

[![GitHub issues](https://img.shields.io/github/issues/denisrpriebe/Handshake.svg)](https://github.com/denisrpriebe/Handshake/issues) [![GitHub forks](https://img.shields.io/github/forks/denisrpriebe/Handshake.svg)](https://github.com/denisrpriebe/Handshake/network) [![GitHub stars](https://img.shields.io/github/stars/denisrpriebe/Handshake.svg)](https://github.com/denisrpriebe/Handshake/stargazers) [![Twitter](https://img.shields.io/twitter/url/https/github.com/denisrpriebe/Handshake.svg?style=social)](https://twitter.com/intent/tweet?text=Yo, checkout this Magento 2 module called Handshake:&url=%5Bobject%20Object%5D)

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

Previously, when you worked with Magento 2 products you probably needed to use the `ProductFactory`, `ProductRepository`, `ProductCollection` and whatever else to accomplish what you wanted to do. This is no longer the case. Instead you may use the `IrishTitan\Handshake\Facades\Product` facade to perform a number of different actions. For example:

To find a product by its ID use the `find` method:

    $product = Product::find(23);
    
To find a product by its SKU use the `whereSku` method:

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
    
To assign a product to a category us the `assignToCategory` method:

    $category = Category::find(2);
    $product = Product::find(13);
     
    $product->assignToCategory($category);
    
  
In the above examples, `whereSku` and `find` both return an instance of `IrishTitan\Handshake\Core\Catalog\Product`. Please check out this class to get a better understanding of how things work.

## Categories

Previously, when you worked with Magento 2 categories you probably needed to use the `CategoryFactory`, `CategoryRepository`, `CategoryCollection` and whatever else to accomplish what you wanted to do. This is no longer the case. Instead you may use the `IrishTitan\Handshake\Facades\Category` facade to perform a number of different actions. For example:

To find a category by its ID use the `find` method:

    $category = Category::find(12);
    
The `find` method will return an instance of `IrishTitan\Handshake\Core\Catalog\Category` if found and `null` if the category is not found. You may also use `findOrFail($id)` method to have an error thrown if the category is not found.

To find a category by its URL key use the `whereUrlKey` method:

    $category = Category::whereUrlKey('shoes');
    
To find a category by its name use the `whereName` method:

    $category = Category::whereName('Shoes');
    
If more than one category have the same name, the first will be returned.

To get all categories use the `all` method:

    $categories = Category::all();
    
To assign a product to a category use the `addProduct` method:

    $nike = Product::whereSku('NIKE0001');
     
    $category = Category::whereUrlKey('shoes');
    $category->addProduct($nike);

If you need to have nested categories you may use the `setParent` method:

    $cars = Category::whereUrlKey('cars');
    $bmws = Category::whereUrlKey('bmws');
     
    $bmws->setParent($cars);
    $bmws->save();

The above are just a handful of methods that you may use. Please checkout the `IrishTitan\Handshake\Core\Catalog\Category` class to see the other available methods.

## CLI Commands

When writing custom functionality for Magento 2 such as an ERP integration or a custom script, it is generally easier to do this as a CLI command. Magento 2 has a command class which you may inherit from but it is still rather tedious to write your own custom commands. Instead you may use the Handshake command class. Before you use the below commands, make sure you module has a `Commands` directory. Ofcourse if you created a module using Handshake's `handshake:make:module` command, this directory will already be present.

To create a new command, here is the syntax to use:

    php bin/magento handshake:make:command Namespace Module CommandName
    
As an example, you may do something like:

    php bin/magento handshake:make:command Acme Forum ImportThreadsCommmand
    
This will create a `ImportThreadsCommmand.php` file in `app/code/Acme/Forum/Commands`.

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
