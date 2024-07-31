<?php

namespace Edeoliv\FilamentTimeline\Components;

use Filament\Infolists\Components\Entry;
use Illuminate\Database\Eloquent\Model;

class TimelineEntry extends Entry
{
    protected string $view = 'filament-timeline::timeline-entry';

    /**
     * @return array<ComponentContainer>
     */
    public function getChildComponentContainers(bool $withHidden = false): array
    {
        if ((! $withHidden) && $this->isHidden()) {
            return [];
        }

        $containers = [];

        foreach ($this->getState() ?? [] as $itemKey => $itemData) {
            $container = $this
                ->getChildComponentContainer()
                ->getClone()
                ->view('filament-timeline::component-container')
                ->statePath($itemKey)
                ->inlineLabel(false);

            if ($itemData instanceof Model) {
                $container->record($itemData);
            }

            $containers[$itemKey] = $container;
        }

        return $containers;
    }
}
