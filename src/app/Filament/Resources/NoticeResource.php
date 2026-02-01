<?php

namespace App\Filament\Resources;

use App\Filament\Resources\NoticeResource\Pages;
use App\Filament\Resources\NoticeResource\RelationManagers;
use App\Models\Notice;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

use Filament\Forms\Get; // [중요] 동적으로 폼 값을 가져오기 위해 필요

class NoticeResource extends Resource
{
    protected static ?string $model = Notice::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = '게시판 관리';

    public static function form(Form $form): Form
    {
        // return $form
        //     ->schema([
        //         //
        //     ]);
        return $form
            ->schema([
                Forms\Components\Section::make('공지 설정')
                    ->schema([
                        // 1. 유형 선택 (live로 설정하여 선택 시 바로 반응)
                        Forms\Components\Select::make('type')
                            ->options([
                                'general' => '일반 게시글',
                                'popup' => '팝업 공지',
                            ])
                            ->default('general')
                            ->required()
                            ->live() // [핵심] 값이 바뀌면 폼을 다시 렌더링
                            ->label('유형'),
                        
                        Forms\Components\Toggle::make('is_active')
                            ->label('노출 여부')
                            ->default(true),

                        // 2. 팝업 기간 (유형이 popup일 때만 보임)
                        Forms\Components\Grid::make(2)
                            ->schema([
                                Forms\Components\DateTimePicker::make('start_date')->label('게시 시작일'),
                                Forms\Components\DateTimePicker::make('end_date')->label('게시 종료일'),
                            ])
                            ->visible(fn (Get $get) => $get('type') === 'popup'), // [핵심] 조건부 표시 로직
                            
                        Forms\Components\TextInput::make('title')
                            ->required()
                            ->columnSpanFull()
                            ->label('제목'),

                        Forms\Components\RichEditor::make('content')
                            ->columnSpanFull()
                            ->label('내용'),
                    ])->columns(2)
            ]);
    }

    public static function table(Table $table): Table
    {
        // return $table
        //     ->columns([
        //         //
        //     ])
        //     ->filters([
        //         //
        //     ])
        //     ->actions([
        //         Tables\Actions\EditAction::make(),
        //     ])
        //     ->bulkActions([
        //         Tables\Actions\BulkActionGroup::make([
        //             Tables\Actions\DeleteBulkAction::make(),
        //         ]),
        //     ]);

        return $table
            ->columns([
                // 배지로 유형을 예쁘게 표시
                Tables\Columns\TextColumn::make('type')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'general' => 'gray',
                        'popup' => 'warning',
                    })
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'general' => '일반',
                        'popup' => '팝업',
                    })
                    ->label('유형'),
                
                Tables\Columns\TextColumn::make('title')->limit(30)->label('제목'),
                Tables\Columns\ToggleColumn::make('is_active')->label('노출'),
                Tables\Columns\TextColumn::make('created_at')->date()->label('작성일'),
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
            'index' => Pages\ListNotices::route('/'),
            'create' => Pages\CreateNotice::route('/create'),
            'edit' => Pages\EditNotice::route('/{record}/edit'),
        ];
    }
}
