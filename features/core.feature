Feature:
  In order to prove that the internal logic work
  i must send multiples request.

  Scenario: I send a request to the homepage.
    When i send a request to "/" using "GET" method.
    Then the status code should be 200

  Scenario: I send a request to a page that doesn't exist.
    When i send a request to "/toto" using "GET" method.
    Then the status code should be 404

  Scenario: I send a request to the register page.
    When i send a request to "/register" using "GET" method.
    Then the status code should be 200

  Scenario: I send a request to the login page.
    When i send a request to "/login" using "GET" method.
    Then the status code should be 200
