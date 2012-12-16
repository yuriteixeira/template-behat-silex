# Behat + Silex #

This is a simple template to guide the first steps on development of a silex application defined and tested by behat features. 

## Requirements ##

* PHP
* PEAR (info [here](http://pear.php.net/manual/en/installation.getting.php))
* PHPUnit (info [here](http://www.phpunit.de/manual/current/en/installation.html#installation.pear))
* Composer (info [here](http://getcomposer.org/doc/00-intro.md#installation-nix))

## Running ##

* Run `composer install` or `php composer.phar install`
* Run `php bin/behat`
* You will (hopefully) see that all tests passed

## What happened? ##

When you run behat...

* It will find the specification files with extension `.feature` inside the `features` folder
* It will match methods to test the features inside the file `feature/bootstrap/FeatureContext.php` through the annotations followed by regular expressions and run them. Specifically, the "Scenario" related methods, on this project, are organized like this:
	* Methods with the annotation `@Given` are fixture methods, used to fill 
	* Methods with the annotation `@When` are calls to our project API
	* Methods with the annotation `@Then` are assertion methods
	
## What's next? ##

* Fork this project
* Create a new feature file (maybe user-list.feature?)
* Define it, following the project examples (more details about how to define features [here](http://docs.behat.org/guides/1.gherkin.html))
* Run `bin/behat -f snippets` to get the method skeleton to acomplish your feature requirements, add them to `feature/bootstrap/FeatureContext.php` and implement the needed coded inside them.
* Run `bin/behat -v` and check if all tests passed
* Problems or suggestions? Submit a pull request and I will try to help through them ;-)




