Feature:
  In order to test the accounting process, i need to
  send multiples requests.

  Scenario: I send a request to the accounting list
    When i send a request to "/api/accountings" using "GET" method
    Then the body must contain "[]"
    Then the response should have status code 200 and be typed "application/json"

  Scenario: I send a request to the accounting details
    When i send a request to "/api/accountings/1" using "GET" method
    Then the body must contain "null"
    Then the response should have status code 200 and be typed "application/json"

  Scenario: I send a request to the accounting creation
    When i send a request to "POST" using "/api/accountings/post" method and with body:
    """
    {
      "name": "Mr test entreprise",
      "interlocutor": "Mr test"
    }
    """
    Then the response should have status code 201 and be typed "application/json"
