Feature:
  In order to prove that the API is functional,
  i must send multiples request.

  Scenario: I send a request to the api entrypoint
    When i send a request to "/api/token" using POST method.
    Then the status code should be 200
