Feature:
  In order to test the bills process, i need to
  send multiples requests.

  Scenario: I send a request to the accounting list
    When i send a request to "/api/bills" using "GET" method
    Then the body must contain "[]"
    Then the response should have status code 200 and be typed "application/json"

  Scenario: I send a request to the accounting list
    When i send a request to "/api/bills/1" using "GET" method
    Then the body must contain "[]"
    Then the response should have status code 200 and be typed "application/json"

  Scenario: I send a request to the accounting list
    When i send a request to "/api/bills/post" using "POST" method
    Then the body must contain "[]"
    Then the response should have status code 200 and be typed "application/json"

  Scenario: I send a request to the accounting list
    When i send a request to "/api/bills/1/put" using "PUT" method
    Then the body must contain "[]"
    Then the response should have status code 200 and be typed "application/json"

  Scenario: I send a request to the accounting list
    When i send a request to "/api/bills/1/patch" using "PATCH" method
    Then the body must contain "[]"
    Then the response should have status code 200 and be typed "application/json"

  Scenario: I send a request to the accounting list
    When i send a request to "/api/bills/1/delete" using "DELETE" method
    Then the body must contain "['message' => 'Resource deleted']"
    Then the response should have status code 202 and be typed "application/json"
