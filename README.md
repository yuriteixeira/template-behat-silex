# Silex API + Behat Tests with Code Coverage + QA Tools 

[![Build Status](https://travis-ci.org/yuriteixeira/template-behat-silex.svg?branch=master)](https://travis-ci.org/yuriteixeira/template-behat-silex)

This example application:

* Uses behat to run integration test (but without the need to have a server running the API to test, improving the speed of the tests)
* Is ready for continuous integration system's (like Travis or Jenkins)
* Runs quality related tasks, like copy/paste detectors, mess detectors, and generates some reports, like **code coverage reports generation** (which is not supported by behat per se)

## Basic Requirements

* PHP >= 5.6 or HHVM
* Composer: https://getcomposer.org/download/

## CI Requirements 

* Ant

## Running the tests ##

* Run `composer install` or `php composer.phar install`
* Run `bin/behat`
* You will (hopefully) see that all tests passed

## Running the tests and all the QA tools, like a CI would do 

* Run `ant` or `ant ci` (which is the one that travis is running)

## What happened? ##

* It will find the specification files with extension `.feature` inside the `features` folder
* It will match methods to test the features inside the file `feature/bootstrap/FeatureContext.php` through the annotations followed by regular expressions and run them. Specifically, the "Scenario" related methods, on this project, are organized like this:
	* Methods with the annotation `@Given` are pre-conditions
	* Methods with the annotation `@When` actions that you will test, like call an endpoint
	* Methods with the annotation `@Then` are assertions that you will make on the results you got from the actions mentioned above (eg: the result of the API call you made)
	
**And of course, if you like and if it fit your needs, just start writing your API based on this code :)**

## What's next? ##

To check if you got the point and have some fun, you could:

* Fork this project
* Create a new feature file (maybe `user-list.feature`?)
* Define it, following this project examples (more details about how to define features [here](http://docs.behat.org/guides/1.gherkin.html))
* Run `bin/behat -f snippets` to get the method skeleton to accomplish your feature requirements, add them to `feature/bootstrap/FeatureContext.php` and implement the needed coded inside them.
* Run `bin/behat -v` and check if all tests passed
* Problems or suggestions? Submit a pull request and I will try to help through them ;-)

**ProTIP**: If you are developing a Single Page App and want to call the endpoints your api based on this project, use PHP's builtin webserver to put it up:

```
$ php -S localhost:8000 web/index.php
```

