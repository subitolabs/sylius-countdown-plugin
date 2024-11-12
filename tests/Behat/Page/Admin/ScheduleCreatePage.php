<?php

declare(strict_types=1);

namespace Tests\Subitolabs\SyliusCountdownPlugin\Behat\Page\Admin;

use Behat\Mink\Element\NodeElement;
use Sylius\Behat\Behaviour\DocumentAccessor;
use Sylius\Behat\Page\Admin\Crud\CreatePage;

class ScheduleCreatePage extends CreatePage
{
    use DocumentAccessor;

    public function containsErrorWithMessage(string $inputElementID): bool
    {
        $inputElement = $this->getDocument()->find('named', [ 'id', $inputElementID ]);

        if ($inputElement === null) {
            return false;
        }

        $parent = $inputElement->getParent();

        return $parent->hasClass('error')
            && $parent->hasClass('required');
    }
}
