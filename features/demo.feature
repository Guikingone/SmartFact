Feature:
  In order to prove that the Behat Symfony extension is correctly installed
  As a user
  I want to have a demo scenario

  Scenario: I send a request to the homepage.
    When i send a request to "/" using "GET" method.
    Then the status code should be 200
