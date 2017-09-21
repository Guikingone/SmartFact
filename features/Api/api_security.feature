Feature:
  In order to prove that the API is functional,
  i must send multiples request.

  Scenario: I send a request to the api entrypoint
    When i send a request to "/api/token" using "POST" method and with body:
    """
    {
      "username": "Toto",
      "password": "heygringo"
    }
    """
    Then the response should have status code 500 and be typed 'application/json'

  Scenario: I send a request to the api entrypoint
    When i send a request to "/api/token" using "POST" method and with body:
    """
    {
      "username": "HP",
      "password": "LB,L8ELTDL0"
    }
    """
    Then the response should have status code 200 and be typed 'application/json'
