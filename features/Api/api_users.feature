Feature:
  In order to test the users process, i need to
  send multiples requests.

  Scenario: I send a request to the api user lists
    When i send a request to "/api/users" using "GET" method
    Then the response should have status code 200 and be typed 'application/json'
    Then the body must contain "[]"

  Scenario: I send a reques to the api user details
    When i send a request to "GET" using "/api/users/1" method
    Then the response should have status code 200 and be typed "application/json"
    Then the body must contain "[]"

  Scenario: I send a reques to the api user creation
    When i send a request to "POST" using "/api/users/post" method and with body:
    """
    {
      ""
    }
    """
    Then the response should have status code 201 and be typed "application/json"
