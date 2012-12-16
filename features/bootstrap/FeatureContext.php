<?php

use Behat\Behat\Context\BehatContext;
use Behat\Gherkin\Node\PyStringNode;
use Symfony\Component\HttpKernel\Client;
use Api\Application;

require_once 'PHPUnit/Autoload.php';
require_once 'PHPUnit/Framework/Assert/Functions.php';

/**
 * Features context.
 */
class FeatureContext extends BehatContext
{

    /**
     * @var Api\Application
     */
    protected $app;

    /**
     * @var \Symfony\Component\BrowserKit\Client
     */
    protected $client;

    /**
     * @BeforeScenario
     */
    public function setup($event)
    {
        $app = new Application();
        $app['debug'] = true;
        unset($app['exception_handler']);
        $this->app = $app;

        $this->client = new Client($this->app);
    }

    /**
     * @When /^call "([^"]*)" "([^"]*)" with parameters:$/
     */
    public function callWithParameters($method, $endpoint, PyStringNode $postParametersStringNode)
    {
        $postParameters = json_decode($postParametersStringNode->getRaw(), true);
        $this->client->request($method, $endpoint, $postParameters);
    }

    /**
     * @Then /^response status is "([^"]*)"$/
     */
    public function responseStatusIs($statusCode)
    {
        assertEquals($statusCode, $this->client->getResponse()->getStatusCode());
    }

    /**
     * @Given /^collection "([^"]*)" having the following data:$/
     */
    public function collectionHavingTheFollowingData($collectionName, PyStringNode $dataStringNode)
    {
        $data = json_decode($dataStringNode->getRaw(), true);

        foreach ($data as $document) {
            $this->app->storage[$collectionName][] = $document;
        }
    }

    /**
     * @When /^call "([^"]*)" "([^"]*)" with resource id "([^"]*)"$/
     */
    public function callWithResourceId($method, $endpoint, $resourceId)
    {
        $this->client->request($method, "{$endpoint}/{$resourceId}");
    }

    /**
     * @Then /^response status should be "([^"]*)"$/
     */
    public function responseStatusShouldBe($statusCode)
    {
        return $this->responseStatusIs($statusCode);
    }

    /**
     * @Given /^json response should be:$/
     */
    public function jsonResponseShouldBe(PyStringNode $expectedResponseStringNode)
    {
        $clientResponse = json_decode($this->client->getResponse()->getContent(), true);
        $expectedResponse = json_decode($expectedResponseStringNode->getRaw(), true);
        assertEquals($expectedResponse, $clientResponse);
    }

    /**
     * @Given /^response content is blank$/
     */
    public function responseContentIsBlank()
    {
        assertEmpty($this->client->getResponse()->getContent());
    }
}
