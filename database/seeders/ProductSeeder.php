<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Product::create([
            'name' => 'Weight Loss Supplement',
            'price' => '3500',
            'description' => 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Ad perspiciatis voluptatibus numquam vitae aut. Similique et eveniet deleniti voluptatem dolores incidunt ipsam, neque cum inventore? Facilis, atque? In numquam quia quo delectus tenetur vitae deleniti nam. Neque commodi accusantium tempora cum minus esse harum, molestias rem impedit mollitia, ab dolorem.'
        ]);
        Product::create([
            'name' => 'Fat Control',
            'price' => '1500',
            'description' => 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Ad perspiciatis voluptatibus numquam vitae aut. Similique et eveniet deleniti voluptatem dolores incidunt ipsam, neque cum inventore? Facilis, atque? In numquam quia quo delectus tenetur vitae deleniti nam. Neque commodi accusantium tempora cum minus esse harum, molestias rem impedit mollitia, ab dolorem.'
        ]);
        Product::create([
            'name' => 'Meal replacment',
            'price' => '2000',
            'description' => 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Ad perspiciatis voluptatibus numquam vitae aut. Similique et eveniet deleniti voluptatem dolores incidunt ipsam, neque cum inventore? Facilis, atque? In numquam quia quo delectus tenetur vitae deleniti nam. Neque commodi accusantium tempora cum minus esse harum, molestias rem impedit mollitia, ab dolorem.'
        ]);
        Product::create([
            'name' => 'Chia Seeds',
            'price' => '400',
            'description' => 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Ad perspiciatis voluptatibus numquam vitae aut. Similique et eveniet deleniti voluptatem dolores incidunt ipsam, neque cum inventore? Facilis, atque? In numquam quia quo delectus tenetur vitae deleniti nam. Neque commodi accusantium tempora cum minus esse harum, molestias rem impedit mollitia, ab dolorem.'
        ]);
        Product::create([
            'name' => 'Day tea Night tea	',
            'price' => '1000',
            'description' => 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Ad perspiciatis voluptatibus numquam vitae aut. Similique et eveniet deleniti voluptatem dolores incidunt ipsam, neque cum inventore? Facilis, atque? In numquam quia quo delectus tenetur vitae deleniti nam. Neque commodi accusantium tempora cum minus esse harum, molestias rem impedit mollitia, ab dolorem.'
        ]);
    }
}
