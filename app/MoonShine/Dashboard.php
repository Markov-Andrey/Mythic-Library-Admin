<?php

namespace App\MoonShine;

use App\Models\Campaign;
use App\Models\Character;
use MoonShine\Dashboard\DashboardBlock;
use MoonShine\Dashboard\DashboardScreen;
use MoonShine\Metrics\ValueMetric;

class Dashboard extends DashboardScreen
{
	public function blocks(): array
	{
        return [
            DashboardBlock::make([
                ValueMetric::make('Персонажи')
                    ->value(Character::all()->count())
                    ->valueFormat('Создано персонажей: {value}')
                    ->progress(100),
                ValueMetric::make('Кампании')
                    ->value(Campaign::all()->count())
                    ->valueFormat('Начато кампаний: {value}')
                    ->progress(100)
            ]),
        ];
	}
}
