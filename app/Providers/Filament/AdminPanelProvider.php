<?php

namespace App\Providers\Filament;

use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Pages;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Widgets;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->id('admin')
            ->path('admin')
            ->login()
            ->colors([
                'primary' => Color::Amber,
            ])
            ->sidebarWidth('16rem')
            ->renderHook(
                'panels::page.start',
                fn (): string => new \Illuminate\Support\HtmlString('
                    <style>
                        .fi-header {
                            position: sticky;
                            top: 0;
                            z-index: 40;
                            background-color: rgba(9, 9, 11, 0.9);
                            backdrop-filter: blur(8px);
                            padding: 1.25rem 2rem !important;
                            margin-bottom: 1rem;
                            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
                        }
                        .fi-header-heading {
                            padding-left: 0.5rem;
                        }
                        .fi-main-ctn, .fi-layout, .fi-page {
                            overflow: visible !important;
                        }
                        /* Repeater Item Styling */
                        .fi-fo-repeater-item {
                            border: 1px solid rgba(255, 255, 255, 0.1) !important;
                            border-radius: 0.75rem !important;
                            overflow: hidden !important;
                            margin-bottom: 1.5rem !important;
                        }
                        .fi-fo-repeater-item-header {
                            background-color: rgba(255, 255, 255, 0.03) !important;
                            padding: 0.75rem 1rem !important;
                        }
                        /* Content Block Specific (Blueish) */
                        .blocks-repeater .fi-fo-repeater-item {
                            background-color: #50a7fa4f !important;
                            border: 1px solid rgba(59, 130, 246, 0.4) !important;
                        }
                        .blocks-repeater .fi-fo-repeater-item-header {
                            background-color: rgba(59, 130, 246, 0.2) !important;
                            border-bottom: 1px solid rgba(59, 130, 246, 0.3) !important;
                        }
                        .fi-fo-repeater-item-header-label {
                            font-weight: 600 !important;
                            color: #fff !important;
                            font-size: 0.9rem !important;
                            text-transform: uppercase;
                            letter-spacing: 0.025em;
                        }
                        /* Repeater Top Header (Label + Collapse/Expand all) */
                        .fi-fo-repeater > .flex {
                            flex-direction: row !important;
                            align-items: center !important;
                            gap: 1.5rem !important;
                            margin-bottom: 0.75rem !important;
                        }
                        .fi-fo-repeater > .flex > .fi-fo-repeater-label {
                            margin-bottom: 0 !important;
                        }
                        /* Tabs Styling (Navigation / List Views) */
                        .fi-tabs, .fi-tabs > nav {
                            background-color: transparent !important;
                            box-shadow: none !important;
                            border: none !important;
                            padding-left: 0 !important;
                            margin-left: 0 !important;
                            margin-top: -0.75rem !important;
                            margin-bottom: 0.25rem !important;
                            justify-content: flex-start !important;
                        }
                        .fi-tabs-item {
                            background-color: transparent !important;
                            border: none !important;
                            padding-left: 1rem !important;
                            padding-right: 1rem !important;
                        }
                        .fi-tabs-item-active {
                             background-color: rgba(255, 255, 255, 0.08) !important;
                             border-radius: 0.5rem !important;
                        }
                    </style>
                '),
            )
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            ->pages([
                Pages\Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
            ->widgets([
                Widgets\AccountWidget::class,
                Widgets\FilamentInfoWidget::class,
            ])
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->authMiddleware([
                Authenticate::class,
            ]);
    }
}
