@admin_managing_schedules
Feature: Adding schedules
    In order to present and manage countdown on my store pages
    As an Administrator
    I want to be able to add new schedules

    Background:
        Given I am logged in as an administrator
        And the store operates on a single channel in "United States"

    @ui
    Scenario: Trying to add schedule with blank data
        When I go to the create schedule page
        And I try to add it
        Then I should be notified that "Code" fields cannot be blank
