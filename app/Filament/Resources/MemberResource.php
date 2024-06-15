<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MemberResource\Pages;
use App\Filament\Resources\MemberResource\RelationManagers;
use App\Models\Members;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class MemberResource extends Resource
{
    protected static ?string $model = Members::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('code')
                    ->label('Kode Member')
                    ->default(fn() => Members::generateCode())
                    ->disabled(),
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->label('Nama')
                    ->placeholder('Masukkan nama')
                    ->maxLength('50'),
                Forms\Components\TextInput::make('email')
                    ->email()
                    ->required()
                    ->label('Email')
                    ->placeholder('Masukkan email')
                    ->maxLength('50'),
                Forms\Components\TextInput::make('phone_number')
                    ->required()
                    ->label('Nomor Telepon')
                    ->placeholder('Masukkan nomor telepon')
                    ->prefix('+62')
                    ->mask('9999-9999-99999')
                    ->maxLength('15'),
                Forms\Components\Textarea::make('address')
                    ->required()
                    ->label('Alamat')
                    ->placeholder('Masukkan alamat'),
                Forms\Components\DatePicker::make('join_date')
                    ->required()
                    ->label('Tanggal Bergabung')
                    ->maxDate(now())
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')->sortable()->searchable()->label('ID'),
                Tables\Columns\TextColumn::make('code')->sortable()->searchable()->label('Kode Member'),
                Tables\Columns\TextColumn::make('name')->sortable()->searchable()->label('Nama'),
                Tables\Columns\TextColumn::make('email')->label('Email'),
                Tables\Columns\TextColumn::make('phone_number')->label('Nomor Telepon'),
                Tables\Columns\TextColumn::make('address')->label('Alamat'),
                Tables\Columns\TextColumn::make('join_date')->sortable()->searchable()->label('Tanggal Bergabung'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListMembers::route('/'),
            'create' => Pages\CreateMember::route('/create'),
            'edit' => Pages\EditMember::route('/{record}/edit'),
        ];
    }
}

