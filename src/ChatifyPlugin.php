<?php

namespace Monzer\FilamentChatifyIntegration;

use Filament\Support\Concerns\EvaluatesClosures;
use Filament\View\PanelsRenderHook;
use Illuminate\Support\Facades\Blade;
use Monzer\FilamentChatifyIntegration\Pages\Chatify;
use Closure;

class ChatifyPlugin implements \Filament\Contracts\Plugin
{
    use EvaluatesClosures;

    protected string|Closure $page = Chatify::class;
    protected bool|Closure $disable_floating_chat_widget = false;

    public static function make(): static
    {
        return app(static::class);
    }

    public function customPage(string|Closure $page): static
    {
        $this->page = $page;
        return $this;
    }
    public function disableFloatingChatWidget(bool|Closure $disable_floating_chat_widget = true): static
    {
        $this->disable_floating_chat_widget = $disable_floating_chat_widget;
        return $this;
    }
    public function getCustomPage()
    {
        return $this->evaluate($this->page);
    }
    public function isFloatingChatWidgetDisabled()
    {
        return $this->evaluate($this->disable_floating_chat_widget);
    }
    public function getId(): string
    {
        return 'chatify-integration';
    }
    public function register(\Filament\Panel $panel): void
    {
        $panel->renderHook(
            PanelsRenderHook::BODY_END,
            fn(): string => Blade::render(
                "<livewire:widget/>"
            ),
        );

        $page = $this->getCustomPage();

        if ($page === Chatify::class)
            $panel->pages([$page]);
    }

    public function boot(\Filament\Panel $panel): void
    {
        // TODO: Implement boot() method.
    }
}
