<?php

declare(strict_types=1);

namespace Tests\Subitolabs\SyliusCountdownPlugin\Behat\Context\Ui\Admin;

use Behat\Behat\Context\Context;
use Behat\Mink\Exception\ElementNotFoundException;
use FriendsOfBehat\PageObjectExtension\Page\UnexpectedPageException;
use Tests\Subitolabs\SyliusCountdownPlugin\Behat\Page\Admin\ScheduleCreatePage;
use Tests\Subitolabs\SyliusCountdownPlugin\Behat\Page\Admin\ScheduleIndexPage;
use Webmozart\Assert\Assert;

final class ScheduleContext implements Context
{
    public function __construct(
        private readonly ScheduleIndexPage $indexPage,
        private readonly ScheduleCreatePage $createPage,
    ) {
    }

    /**
     * @When I go to the schedules page
     * @throws UnexpectedPageException
     */
    public function iGoToTheBlocksPage(): void
    {
        $this->indexPage->open();
    }

    /**
     * @When I delete this block
     */
    public function iDeleteThisBlock(): void
    {
        $this->indexPage->deleteResourceOnPage([]);
    }

    /**
     * @When I go to the create schedule page
     * @throws UnexpectedPageException
     */
    public function iGoToTheSchedulesPage(): void
    {
        $this->createPage->open();
    }

    /**
     * @When I add it
     * @When I try to add it
     * @throws ElementNotFoundException
     */
    public function iAddIt(): void
    {
        $this->createPage->create();
    }

    /**
     * @Then I should be notified that :fields fields cannot be blank
     */
    public function iShouldBeNotifiedThatFieldsCannotBeBlank(string $fields): void
    {
        $fields = explode(',', $fields);

        foreach ($fields as $field) {
            Assert::true($this->createPage->containsErrorWithMessage('subitolabs_countdown_schedule_code'));
        }
    }
}
