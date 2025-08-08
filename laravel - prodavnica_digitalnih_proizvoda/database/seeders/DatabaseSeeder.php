<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Category;
use App\Models\Recipe;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $user = User::factory(5)->create();

        // Kreiranje kategorija torti
        $category1 = Category::firstOrCreate([
            'name' => 'Čokoladne',
            'description' => 'Bogate i ukusne čokoladne torte za svaku priliku.'
        ]);

        $category2 = Category::firstOrCreate([
            'name' => 'Voćne',
            'description' => 'Sveže i lagane voćne torte sa ukusnim filovima.'
        ]);

        $category3 = Category::firstOrCreate([
            'name' => 'Posne',
            'description' => 'Posne torte pripremljene bez mlečnih proizvoda i jaja.'
        ]);

        // Čokoladne torte
        $chocolateCakes = [
            [
                'title' => 'Čoko-nugat torta',
                'description' => 'Ukusna i bogata čokoladna torta, idealna za rođendane.',
                'pdf_path' => 'recipes/chocolate-cake.pdf',
                'views' => 0,
                'downloads' => rand(0, 50),
            ],
            [
                'title' => 'Ferrero torta',
                'description' => 'Čokoladne korice, bogati sloj pečenog lešnika i Nutelle sa dodatkom čokoladnog fila.',
                'pdf_path' => 'recipes/ferrero.pdf',
                'views' => 0,
                'downloads' => rand(0, 50),
            ],
            [
                'title' => 'Kinder torta',
                'description' => 'Preko korica je eurokrem, a preko krema filovi od vanile i čokolade između kojih se stavlja Plazma keks.',
                'pdf_path' => 'recipes/kinder.pdf',
                'views' => 0,
                'downloads' => rand(0, 50),
            ],
            [
                'title' => 'Nutella-Oreo torta',
                'description' => 'Tamne korice natopljene Nutellom, vanila fil s belom čokoladom i drobljenim Oreo keksom.',
                'pdf_path' => 'recipes/nutella-oreo.pdf',
                'views' => 0,
                'downloads' => rand(0, 50),
            ],
        ];

        foreach ($chocolateCakes as $cake) {
            Recipe::create(array_merge($cake, ['category_id' => $category1->id]));
        }

        // Voćne torte
        $fruitCakes = [
            [
                'title' => 'Banana torta',
                'description' => 'Lagane korice, vanila fil, banane, slatka pavlaka.',
                'pdf_path' => 'recipes/banana-torta.pdf',
                'views' => 0,
                'downloads' => rand(0, 50),
            ],
            [
                'title' => 'Švarcvald torta',
                'description' => 'Korice od čokolade, vanila fil, višnje i slatka pavlaka.',
                'pdf_path' => '',
                'views' => 0,
                'downloads' => rand(0, 50),
            ],
            [
                'title' => 'Moskva torta',
                'description' => 'Lagane korice od lešnika, vanila fil, slatka pavlaka, lešnik, višnja i ananas.',
                'pdf_path' => '',
                'views' => 0,
                'downloads' => rand(0, 50),
            ],
            [
                'title' => 'Kranč-jagoda torta',
                'description' => 'Čokoladne korice, nadev od jagoda, lagani vanila fil sa kranč kuglicama.',
                'pdf_path' => '',
                'views' => 0,
                'downloads' => rand(0, 50),
            ],
        ];

        foreach ($fruitCakes as $cake) {
            Recipe::create(array_merge($cake, ['category_id' => $category2->id]));
        }

        // Posne torte
        $fastingCakes = [
            [
                'title' => 'Posna kapri torta',
                'description' => 'Posne korice, posni vanila krem, jagoda, posni šlag.',
                'pdf_path' => '',
                'views' => 0,
                'downloads' => rand(0, 50),
            ],
            [
                'title' => 'Posna reforma torta',
                'description' => 'Posne korice sa orasima filovane posnim čokoladnim kremom.',
                'pdf_path' => '',
                'views' => 0,
                'downloads' => rand(0, 50),
            ],
            [
                'title' => 'Posna nugat-malina torta',
                'description' => 'Posne korice, posni vanila krem, malina, posna pavlaka, lešnik.',
                'pdf_path' => '',
                'views' => 0,
                'downloads' => rand(0, 50),
            ],
            [
                'title' => 'Posna Plazma torta',
                'description' => 'Posne korice prelivene sokom, bogat fil od posne čokolade i mlevene Plazme.',
                'pdf_path' => '',
                'views' => 0,
                'downloads' => rand(0, 50),
            ],
        ];

        foreach ($fastingCakes as $cake) {
            Recipe::create(array_merge($cake, ['category_id' => $category3->id]));
        }
    }
}
