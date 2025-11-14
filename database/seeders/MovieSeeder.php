<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Movie;
use App\Models\Genre;

class MovieSeeder extends Seeder
{
    public function run(): void
    {
        $movies = [
            [
                'title' => 'Guardians of the Galaxy Vol. 4',
                'description' => 'The Guardians embark on their most dangerous mission yet.',
                'poster_url' => 'https://image.tmdb.org/t/p/w300/r2J02Z2OpNTctfOSN1Ydgii51I3.jpg',
                'release_year' => 2026,
                'average_rating' => 8.7,
            ],
            [
                'title' => 'Avengers: Doomsday',
                'description' => 'The Avengers face their greatest challenge yet as they battle to save the world from ultimate destruction.',
                'poster_url' => 'https://image.tmdb.org/t/p/w300/7WsyChQLEftFiDOVTGkv3hFpyyt.jpg', // Avengers poster
                'release_year' => 2026,
                'average_rating' => 9.5,
            ],
            [
                'title' => 'Fantastic Four',
                'description' => 'The First Family of Marvel returns in a groundbreaking new film.',
                'poster_url' => 'https://image.tmdb.org/t/p/w300/9YEGawvjaRgnyW6QVcUhFJPFDco.jpg',
                'release_year' => 2025,
                'average_rating' => 8.0,
            ],
            [
                'title' => 'Spider-Man: Brand New Day',
                'description' => 'Spider-Man embarks on a fresh start, balancing heroism and personal life in a new era.',
                'poster_url' => 'https://image.tmdb.org/t/p/w300/1Rr5SrvHxMXHu5RjKpaMba8VTzi.jpg', // Spider-Man poster
                'release_year' => 2025,
                'average_rating' => 8.8,
            ],
            [
                'title' => 'Venom: The Last Dance',
                'description' => 'Eddie Brock and Venom face their final showdown.',
                'poster_url' => 'https://image.tmdb.org/t/p/w300/aosm8NMQ3UyoBVpSxyimorCQykC.jpg',
                'release_year' => 2024,
                'average_rating' => 8.5,
            ],
            [
                'title' => 'Deadpool & Wolverine',
                'description' => 'Deadpool teams up with Wolverine for an outrageous adventure.',
                'poster_url' => 'https://image.tmdb.org/t/p/w300/8cdWjvZQUExUUTzyp4t6EDMubfO.jpg',
                'release_year' => 2024,
                'average_rating' => 9.2,
            ],
            [
                'title' => 'Ant-Man and the Wasp: Quantumania',
                'description' => 'Ant-Man and the Wasp explore the Quantum Realm.',
                'poster_url' => 'https://image.tmdb.org/t/p/w300/ngl2FKBlU4fhbdsrtdom9LVLBXw.jpg',
                'release_year' => 2023,
                'average_rating' => 6.5,
            ],
            [
                'title' => 'Black Panther: Wakanda Forever',
                'description' => 'The sequel to the groundbreaking Black Panther film.',
                'poster_url' => 'https://image.tmdb.org/t/p/w300/sv1xJUazXeYqALzczSZ3O6nkH75.jpg',
                'release_year' => 2022,
                'average_rating' => 7.8,
            ],
            // [
            //     'title' => 'Captain America: Brave New World',
            //     'description' => 'Sam Wilson takes up the mantle of Captain America in a new era of heroism.',
            //     'poster_url' => 'https://image.tmdb.org/t/p/w300/puVCupTQZxvJAz3ZYiFxH6bVCrm.jpg',
            //     'release_year' => 2025,
            //     'average_rating' => 8.2,
            // ],
            // [
            //     'title' => 'Thunderbolts',
            //     'description' => 'A team of anti-heroes is assembled for a high-stakes mission.',
            //     'poster_url' => 'https://image.tmdb.org/t/p/w300/mHaKlgGgQmFkNkvwCQ8fLwsXMXh.jpg',
            //     'release_year' => 2025,
            //     'average_rating' => 7.9,
            // ],
            // [
            //     'title' => 'Blade',
            //     'description' => 'The legendary vampire hunter returns in a new action-packed adventure.',
            //     'poster_url' => 'https://image.tmdb.org/t/p/w300/5M8X5N3VzLdKVzr5QK0Bq7gXPQK.jpg',
            //     'release_year' => 2025,
            //     'average_rating' => 8.1,
            // ],
            // [
            //     'title' => 'Fantastic Four',
            //     'description' => 'The First Family of Marvel returns in a groundbreaking new film.',
            //     'poster_url' => 'https://image.tmdb.org/t/p/w300/9YEGawvjaRgnyW6QVcUhFJPFDco.jpg',
            //     'release_year' => 2025,
            //     'average_rating' => 8.0,
            // ],
            // [
            //     'title' => 'Deadpool & Wolverine',
            //     'description' => 'Deadpool teams up with Wolverine for an outrageous adventure.',
            //     'poster_url' => 'https://image.tmdb.org/t/p/w300/8cdWjvZQUExUUTzyp4t6EDMubfO.jpg',
            //     'release_year' => 2024,
            //     'average_rating' => 9.2,
            // ],
            // [
            //     'title' => 'Venom: The Last Dance',
            //     'description' => 'Eddie Brock and Venom face their final showdown.',
            //     'poster_url' => 'https://image.tmdb.org/t/p/w300/aosm8NMQ3UyoBVpSxyimorCQykC.jpg',
            //     'release_year' => 2024,
            //     'average_rating' => 8.5,
            // ],
            // [
            //     'title' => 'X-Men \'97',
            //     'description' => 'The X-Men continue their fight for peace and equality.',
            //     'poster_url' => 'https://image.tmdb.org/t/p/w300/8X2IPF0nZ6AJMQ8HtYjXzHtTgWJ.jpg',
            //     'release_year' => 2024,
            //     'average_rating' => 8.3,
            // ],
            // [
            //     'title' => 'Guardians of the Galaxy Vol. 4',
            //     'description' => 'The Guardians embark on their most dangerous mission yet.',
            //     'poster_url' => 'https://image.tmdb.org/t/p/w300/r2J02Z2OpNTctfOSN1Ydgii51I3.jpg',
            //     'release_year' => 2026,
            //     'average_rating' => 8.7,
            // ],
            // [
            //     'title' => 'Black Panther: Wakanda Forever',
            //     'description' => 'The sequel to the groundbreaking Black Panther film.',
            //     'poster_url' => 'https://image.tmdb.org/t/p/w300/sv1xJUazXeYqALzczSZ3O6nkH75.jpg',
            //     'release_year' => 2022,
            //     'average_rating' => 7.8,
            // ],
            // [
            //     'title' => 'Ant-Man and the Wasp: Quantumania',
            //     'description' => 'Ant-Man and the Wasp explore the Quantum Realm.',
            //     'poster_url' => 'https://image.tmdb.org/t/p/w300/ngl2FKBlU4fhbdsrtdom9LVLBXw.jpg',
            //     'release_year' => 2023,
            //     'average_rating' => 6.5,
            // ],
        ];

        foreach ($movies as $data) {
            $movie = Movie::create($data);
            $movie->genres()->attach(
                Genre::inRandomOrder()->take(rand(1, 3))->pluck('id')
            );
        }
    }
}
