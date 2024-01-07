<?php

namespace App\Order\Application\Observer;

use App\Order\Domain\Entity\Order;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;

class RemoveCartItemListener implements EventSubscriberInterface
{
    public static function getSubscribedEvents(): array
    {
        return [FormEvents::POST_SUBMIT => 'postSubmit'];
    }

    public function postSubmit(FormEvent $event): void
    {
        $form = $event->getForm();
        $order = $form->getData();

        if (!$order instanceof Order) {
            return;
        }

        foreach ($form->get('items')->all() as $child) {
            if ($child->get('remove')->isClicked()) {
                $order->removeItem($child->getData());
                break;
            }
        }
    }
}