<?php

namespace App\Models;

use Filament\Forms\Components\CheckboxList;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;

class Speaker extends Model
{
    use HasFactory;

    protected $casts = [
        'id' => 'integer',
        'qualifications' => 'array',
    ];

    public function conferences(): BelongsToMany
    {
        return $this->belongsToMany(Conference::class);
    }

    public static function getForm(): array
    {
        return [
            TextInput::make('name')
                ->required()
                ->maxLength(255),
            TextInput::make('email')
                ->email()
                ->required()
                ->maxLength(255),
            Textarea::make('bio')
                ->required()
                ->maxLength(65535)
                ->columnSpanFull(),
            TextInput::make('twitter_handle')
                ->required()
                ->maxLength(255),
            CheckboxList::make('qualifications')
                ->columnSpanFull()
                ->searchable()
                ->bulkToggleable()
                ->options([
                    'business-leader' => 'Business Leader',
                    'charismatic' => 'Charismatic Speaker',
                    'first-time' => 'First Time Speaker',
                    'laracasts-contributor' => 'laracasts Contributor',
                    'open-source-contributor' => 'Open Source Contributor',
                ])
                ->descriptions([
                    'business-leader' => 'Has led a business',
                    'charismatic' => 'Has a charismatic personality',
                    'first-time' => 'Has never spoken at a conference before',
                    'laracasts-contributor' => 'Has contributed to laracasts',
                    'open-source-contributor' => 'Has contributed to open source',
                ])
                ->columns(3),
        ];
    }
}
