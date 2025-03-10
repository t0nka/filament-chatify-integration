@php
    $plugin = filament()->getPlugin('chatify-integration');
    $page = $plugin->getCustomPage();
    $is_floating_chat_widget_disabled = $plugin->isFloatingChatWidgetDisabled();
    $chat_url = app()->make($page)::getUrl() ?? route('chatify');
@endphp
<div>
    @if(! $is_floating_chat_widget_disabled)
        <div wire:poll.30s="updateMessagesCount">
            <button class="chat-button" onclick="window.open('{{ $chat_url }}', '_blank')">
                <svg class="chat-icon" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" fill="none">
                    <path
                        d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5Z"/>
                </svg>
                @if($messages_count > 0)
                    <div class="message-badge" id="message-count">{{ $messages_count }}</div>
                @endif
            </button>
        </div>
    @endif
</div>
