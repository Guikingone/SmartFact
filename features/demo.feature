Feature:
  In order to prove that the Behat Symfony extension is correctly installed
  As a user
  I want to have a demo scenario

  Scenario: I send a request to the Homepage.
    When i send a request to "/" using "GET" method.
    Then the status code should be 200

  Scenario: I want to register a new account
    When i send a request to "/login" using "GET" method.
    Then the status code should be 200

  Scenario: I want to register a new account
    When i send a request to "/register" using "GET" method.
    Then the status code should be 200
