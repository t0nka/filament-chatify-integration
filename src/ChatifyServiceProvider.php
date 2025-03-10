<?php

namespace Monzer\FilamentChatifyIntegration;

use Spatie\LaravelPackageTools\Commands\InstallCommand;
use Filament\Support\Assets\Css;
use Filament\Support\Facades\FilamentAsset;
use Livewire\Livewire;
use Monzer\FilamentChatifyIntegration\Livewire\Widget;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class ChatifyServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package
            ->name('filament-chatify-integration')
            ->hasViews()
            ->hasAssets()
            ->hasInstallCommand(function (InstallCommand $installCommand) {
                $installCommand->startWith(function (InstallCommand $command) {
                    $command->info('Hello, and welcome to the installation process of our package!');
                    $command->newLine(1);
                    $command->comment('We are now going to install chatify on your behalf via chatify:install command.');
                })
                    ->publishConfigFile()
                    ->endWith(function (InstallCommand $installCommand) {
                        $installCommand->call(\Chatify\Console\InstallCommand::class);
                        $installCommand->newLine(1);
                        $installCommand->info('========================================================================================================');
                        $installCommand->info("All done, please look for chatify.php in your config directory.");
                        $installCommand->info('========================================================================================================');

                        $installCommand->info('🌟 If you find this package useful, please consider starring it on GitHub!');
                        $installCommand->comment('👉 https://github.com/monzer15/filament-chatify-integration');
                        $installCommand->newLine(2);
                    });
            })
            ->hasTranslations();

        FilamentAsset::register([
            Css::make('chatify-integration', __DIR__ . '/../resources/css/chatify-integration.css'),
        ]);

        Livewire::component('widget', Widget::class);
    }
}
