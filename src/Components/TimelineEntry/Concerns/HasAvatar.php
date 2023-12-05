<?php

namespace Saade\FilamentTimeline\Components\TimelineEntry\Concerns;

use Closure;
use Saade\FilamentTimeline\Components\TimelineEntry\Enums\Size;

trait HasAvatar
{
    protected Size | string | Closure | null $avatarSize = null;

    protected string | Closure | null $avatar = null;

    public function avatar(string | Closure | null $avatar): static
    {
        $this->avatar = $avatar;

        return $this;
    }

    public function avatarSize(Size | string | Closure | null $size): static
    {
        $this->avatarSize = $size;

        return $this;
    }

    public function getAvatar(): ?string
    {
        return $this->evaluate($this->avatar, [
            'state' => $this->getState(),
        ]);
    }

    public function getAvatarSize(): Size | string | null
    {
        return $this->evaluate($this->avatarSize, [
            'state' => $this->getState(),
        ]);
    }
}
