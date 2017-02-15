<?php

use Illuminate\Database\Seeder;

class WordsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('words')->insert([
            ['word'=>'people'],
            ['word'=> 'history'],
            ['word'=> 'way'],
            ['word'=> 'art'],
            ['word'=> 'world'],
            ['word'=> 'information'],
            ['word'=> 'map'],
            ['word'=> 'two'],
            ['word'=> 'family'],
            ['word'=> 'government'],
            ['word'=> 'health'],
            ['word'=> 'system'],
            ['word'=> 'computer'],
            ['word'=> 'meat'],
            ['word'=> 'year'],
            ['word'=> 'thanks'],
            ['word'=> 'music'],
            ['word'=> 'person'],
            ['word'=> 'reading'],
            ['word'=> 'method'],
            ['word'=> 'data'],
            ['word'=> 'food'],
            ['word'=> 'understanding'],
            ['word'=> 'theory'],
            ['word'=> 'law'],
            ['word'=> 'bird'],
            ['word'=> 'literature'],
        ]);
    }
}
