Feature: Create a new user
    In order to if the API is working
    As an API consumer
    I need to see a welcome message :)

    Scenario: Access root enpoint and see welcome message
        When call "GET" "/"
        Then response status is "200"
        And response content is "Welcome!"
