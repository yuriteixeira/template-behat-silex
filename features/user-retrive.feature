Feature: Get user info
    In order get info about a user
    As an API consumer
    I need to request and get user info

    Background:
        Given collection "users" having the following data:
        """
        [
            {"login": "yuri", "name": "Right Yuri Teixeira", "birthdate": "1984-05-16"},
            {"login": "Yuri", "name": "Wrong Yuri Teixeira", "birthdate": "1989-05-16"}
        ]
        """

    Scenario: User that exists
        When call "GET" "/user" with resource id "yuri"
        Then response status should be "200"
        And json response should be:
        """
        {
            "login": "yuri",
            "name": "Right Yuri Teixeira",
            "birthdate": "1984-05-16"
        }
        """

    Scenario: User that doesn't exists
        When call "GET" "/user" with resource id "not-here"
        Then response status should be "404"
