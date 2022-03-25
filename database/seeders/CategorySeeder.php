<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;


class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            'category_name_en' => 'boards',
            'category_name_ru' => 'доски',
            'category_item_en' => 'board',
            'category_item_ru' => 'доска',
            'category_id'=>'1',
            'category_description' => 'Дека скейтборда - это верхняя часть скейтборда на которую ставятся ноги. Все начинается с подбора деки. Если вы новичок, то вам поможет наша специальная таблица с размерами и инструкциями - как выбрать. Выбор деки зависит от стиля вашего катания и размера ноги.'
        ]);

        DB::table('categories')->insert([
            'category_name_en' => 'suspensions',
            'category_name_ru' => 'подвески',
            'category_item_en' => 'suspension',
            'category_item_ru' => 'подвеска',
            'category_id'=>'2',
            'category_description' => 'Подвеска скейтборда это деталь Т-образной формы находящаяся под декой, и к которой крепятся колеса. Подвески являются ключевым звеном в передаче ваших движений деке и реакции на них. С правильно выбранной подвеской, вы и ваш скейтборд смогут больше наслаждаться ездой.'
        ]);

        DB::table('categories')->insert([
            'category_name_en' => 'wheels',
            'category_name_ru' => 'колоса',
            'category_item_en' => 'wheel',
            'category_item_ru' => 'колесо',
            'category_id'=>'3',
            'category_description' => 'Колёса для скейтборда отвечают за перемещение, скорость и скольжение твоего скейтборда по припятствию при выполнении некоторых трюков на нем.'
        ]);

        DB::table('categories')->insert([
            'category_name_en' => 'bearings',
            'category_name_ru' => 'подшипники',
            'category_item_en' => 'bearing',
            'category_item_ru' => 'подшипник',
            'category_id'=>'4',
            'category_description' => 'Любые подшипники для скейтборда определяют возможность его движения. Они же отвечают за скорость хода. Обычно подшипники на скейт поставляются в комплектации из 8 штук – по два на колесо. Для того, чтобы купить нужные подшипники для скейтборда, стоит обратить внимание на его размер. К стандартным параметрам этого элемента относится размер 8х22х7 мм или маркировка 608ZZ.'
        ]);
    }
}
