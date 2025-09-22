<?php

namespace Monzer\FilamentChatifyIntegration\Pages;

use Filament\Pages\Page;

class Chatify extends Page
{
    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-chat-bubble-oval-left';
    protected string $view = 'filament-chatify-integration::pages.chatify';
    protected static ?string $navigationLabel = "Chatify";
    protected static ?string $title = "Chatify";
    protected static ?string $slug = "chatify";
    
}
