<?php

declare(strict_types=1);

namespace Subitolabs\SyliusCountdownPlugin\Form;

use Sylius\Bundle\ResourceBundle\Form\EventSubscriber\AddCodeFormSubscriber;
use Sylius\Bundle\ResourceBundle\Form\Type\AbstractResourceType;
use Symfony\Component\DependencyInjection\Attribute\AutoconfigureTag;
use Symfony\Component\DependencyInjection\Attribute\Autowire;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;

#[AutoconfigureTag('form.type')]
class ScheduleType extends AbstractResourceType
{
    public function __construct(
        #[Autowire('%subitolabs_countdown_plugin.model.schedule.class%')]
        string $dataClass,
        #[Autowire(['%kernel.project_dir%/config/dir'])]
        array $validationGroups = [])
    {
       parent::__construct($dataClass, $validationGroups);
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->addEventSubscriber(new AddCodeFormSubscriber())

            ->add('enabled', CheckboxType::class, [
                'label' => 'sylius.form.channel.enabled'
            ])

            ->add('startsAt', DateType::class, [
                'label' => 'setono_sylius_shipping_countdown.form.shipping_schedule.starts_at',
                'help' => 'setono_sylius_shipping_countdown.form.shipping_schedule.starts_at_help',
                'widget' => 'single_text',
                'required' => false,
            ])
            ->add('endsAt', DateType::class, [
                'label' => 'setono_sylius_shipping_countdown.form.shipping_schedule.ends_at',
                'help' => 'setono_sylius_shipping_countdown.form.shipping_schedule.ends_at_help',
                'widget' => 'single_text',
                'required' => false,
            ])
            ->add('priority', IntegerType::class, [
                'label' => 'setono_sylius_shipping_countdown.form.shipping_schedule.priority',
                'required' => false,
            ])
        ;
    }

    public function getBlockPrefix(): string
    {
        return 'setono_sylius_shipping_countdown_shipping_schedule';
    }
}
