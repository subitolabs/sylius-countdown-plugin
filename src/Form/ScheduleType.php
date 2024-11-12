<?php

declare(strict_types=1);

namespace Subitolabs\SyliusCountdownPlugin\Form;

use Subitolabs\SyliusCountdownPlugin\Entity\ScheduleInterface;
use Sylius\Bundle\ResourceBundle\Form\Type\AbstractResourceType;
use Symfony\Component\DependencyInjection\Attribute\AutoconfigureTag;
use Symfony\Component\DependencyInjection\Attribute\Autowire;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

#[AutoconfigureTag('form.type')]
class ScheduleType extends AbstractResourceType
{
    public function __construct(
        #[Autowire('%subitolabs_countdown_plugin.model.schedule.class%')]
        string $dataClass
    )
    {
       parent::__construct($dataClass);
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        /** @var ScheduleInterface $data */
        $data = $builder->getData();

        $builder
            ->add('enabled', CheckboxType::class, [
                'label' => 'sylius.form.channel.enabled'
            ])
            ->add('code', TextType::class, [
                'label' => 'sylius.ui.code',
                'disabled' => null !== $data->getCode(),
                'required' => true,

            ])

            ->add('startsAt', DateType::class, [
                'label' => 'subitolabs_countdown_schedule.form.shipping_schedule.starts_at',
                'help' => 'subitolabs_countdown_schedule.form.shipping_schedule.starts_at_help',
                'widget' => 'single_text',
                'required' => false,
            ])
            ->add('endsAt', DateType::class, [
                'label' => 'subitolabs_countdown_schedule.form.shipping_schedule.ends_at',
                'help' => 'subitolabs_countdown_schedule.form.shipping_schedule.ends_at_help',
                'widget' => 'single_text',
                'required' => false,
            ])
            ->add('priority', IntegerType::class, [
                'label' => 'subitolabs_countdown_schedule.form.shipping_schedule.priority',
                'required' => false,
            ])
        ;
    }

    public function getBlockPrefix(): string
    {
        return 'subitolabs_countdown_schedule';
    }
}
