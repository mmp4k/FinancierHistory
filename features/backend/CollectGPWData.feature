Feature: In order to collect data from Warsaw Stock Exchange
  As a owner
  I would like to fetch data from stooq csv

  Scenario: Collect ETFs
    Given There are csv file, individual for ETFW20L, ETFSP500, ETFDAX
    When I fetch that CSV files
    Then I should get high, low, closing and opening price, volume

  Scenario: Collect shares
    Given There is csv file for each share
    When I fetch that CSV files
    Then I should get high, low, closing and opening price, volume