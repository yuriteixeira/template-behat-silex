Feature: Create a new user
    In order to create a new user
    As an API consumer
    I need to create a new user

    Scenario Outline: Create new user with login not choosed before should succeed
        When call "POST" "/user" with parameters:
        """
        {
            "login": "<login>",
            "name": "<name>"
        }
        """
        Then response status is "<status>"
        Examples:
            | login | name       | status |
            | yuri  | Yuri       | 200    |
            | test  | Test       | 200    |

    Scenario: Create new user with login choosed before should fail
        Given collection "users" having the following data:
        """
        [
            {"login": "yuri", "name": "Yuri Teixeira", "birthdate": "1984-05-16"}
        ]
        """
        When call "POST" "/user" with parameters:
        """
        {
            "login": "yuri",
            "name": "Yuri Teixeira"
        }
        """
        Then response status is "400"
        And response content is blank