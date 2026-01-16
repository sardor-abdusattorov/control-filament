<?php

namespace App\Filament\Pages\Settings;

use AbdulmajeedJamaan\FilamentTranslatableTabs\TranslatableTabs;
use Closure;

use Filament\Forms;
use Outerweb\FilamentSettings\Filament\Pages\Settings as BaseSettings;

class Settings extends BaseSettings
{

    public static function getNavigationLabel(): string
    {
        return __('app.label.main_settings');
    }

    protected static ?int $navigationSort = 1;

    public function getTitle(): string
    {
        return __('app.label.main_settings');
    }

    protected static ?string $navigationGroup = 'settings';

    public static function getNavigationGroup(): ?string
    {
        return __('app.label.settings');
    }

    public function schema(): array|Closure
    {
        return [
            Forms\Components\Tabs::make(__('app.label.settings'))
                ->persistTabInQueryString()
                ->schema([
                    Forms\Components\Tabs\Tab::make(__('app.label.tab_seo'))
                        ->schema([

                            TranslatableTabs::make('seo_translations')
                                ->schema([
                                    Forms\Components\TextInput::make('seo.title')
                                        ->label(__('app.label.seo_title'))
                                        ->required(),

                                    Forms\Components\Textarea::make('seo.description')
                                        ->label(__('app.label.seo_description'))
                                        ->rows(4)
                                        ->required(),

                                    Forms\Components\Textarea::make('seo.keywords')
                                        ->label(__('app.label.seo_keywords'))
                                        ->rows(4),
                                ]),
                        ]),
                ]),
        ];
    }
}
