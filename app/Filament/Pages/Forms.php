<?php

namespace App\Filament\Pages;

use App\Models\FormSubmission;
use Filament\Pages\Page;
use Illuminate\Support\Facades\File;

class Forms extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-duplicate';
    protected static ?string $navigationLabel = 'Forms';
    protected static ?string $navigationGroup = 'Forms';
    protected static ?int $navigationSort = -1;

    protected static string $view = 'filament.pages.forms';

    public function getViewData(): array
    {
        $formsPath = resource_path('views/forms');
        $files = File::exists($formsPath) ? File::files($formsPath) : [];
        
        $forms = [];
        foreach ($files as $file) {
            if ($file->getExtension() !== 'php') continue;
            
            $formName = str_replace('.blade.php', '', $file->getFilename());
            $submissionsCount = FormSubmission::where('form_name', $formName)->count();
            $lastSubmission = FormSubmission::where('form_name', $formName)->latest()->first();

            $forms[] = [
                'name' => ucfirst($formName),
                'path' => 'resources/views/forms/' . $file->getFilename(),
                'submissions' => $submissionsCount,
                'last_submission' => $lastSubmission ? $lastSubmission->created_at->diffForHumans() : 'Never',
                'raw_name' => $formName,
            ];
        }

        return [
            'forms' => $forms,
        ];
    }
}
