<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AdminResource\Pages;
use App\Filament\Resources\AdminResource\RelationManagers;
use App\Models\Admin;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

use Illuminate\Support\Facades\Hash;

class AdminResource extends Resource
{
    protected static ?string $model = Admin::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = '사용자 관리';

    public static function form(Form $form): Form
    {
        // return $form
        //     ->schema([
        //         //
        //     ]);
        return $form
            ->schema([
                Forms\Components\Section::make('관리자 정보')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->required()
                            ->label('이름'),
                        Forms\Components\TextInput::make('email')
                            ->email()
                            ->required()
                            ->unique(ignoreRecord: true) // 수정 시 내 이메일은 중복 체크 제외
                            ->label('이메일'),
                        
                        // [핵심] 비밀번호 암호화 로직
                        Forms\Components\TextInput::make('password')
                            ->password()
                            ->label('비밀번호')
                            ->dehydrateStateUsing(fn ($state) => Hash::make($state)) // 저장 시 암호화
                            ->dehydrated(fn ($state) => filled($state)) // 값이 있을 때만 저장 (수정 시 빈칸이면 유지)
                            ->required(fn (string $context): bool => $context === 'create'), // 생성할 때만 필수
                    ])->columns(2)
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListAdmins::route('/'),
            'create' => Pages\CreateAdmin::route('/create'),
            'edit' => Pages\EditAdmin::route('/{record}/edit'),
        ];
    }
}
