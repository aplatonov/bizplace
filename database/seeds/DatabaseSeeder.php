<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        DB::table('roles')->insert([
            ['title' => 'Администратор', 'slug' => 'admin'],
            ['title' => 'Пользователь', 'slug' => 'user']
        ]);  

        DB::table('users')->insert([
            ['login' => 'admin',
            'email' => 'a432974@yandex.ru',
            'password' => bcrypt('admin'),
            'name' => 'ООО "Софт-"',
            'contact_person' => 'менеджер Петрова Юлия',
            'phone' => '+7-927-456-78-90',
            'role_id' => 1,
            'valid' => true,
            'confirmed' => true],

            ['login' => 'user',
            'email' => 'fake@yandex.ru',
            'password' => bcrypt('user'),
            'name' => 'ИП "Копатель"',
            'contact_person' => 'директор Копков Игорь',
            'phone' => '+7-123-456-78-90',
            'role_id' => 2,
            'valid' => true,
            'confirmed' => true]
        ]);

        DB::table('speciality')->insert([
            ['name' => 'Веб-разработка'],
            ['name' => 'Мобильные приложения'],
            ['name' => 'Системное ПО'],
            ['name' => 'Прикладное ПО'],
            ['name' => 'Интеграция'],
            ['name' => 'DevOps']
        ]); 

        DB::table('technology')->insert([
            ['name' => 'MySQL'],
            ['name' => 'MSSQL'],
            ['name' => 'HTML/CSS'],
            ['name' => 'JavaScript'],
            ['name' => 'PHP'],
            ['name' => 'Java'],
            ['name' => 'SCALA'],
            ['name' => 'Python'],
            ['name' => 'BigData'],
            ['name' => '.NET'],
            ['name' => 'Smarty'],
            ['name' => 'ООП'],
            ['name' => 'Design Patterns'],
            ['name' => 'Laravel'],
            ['name' => 'Yii'],
            ['name' => 'Zend'],
            ['name' => 'Bitrix'],
            ['name' => 'Vagrant'],
            ['name' => 'Docker'],
            ['name' => 'CSS'],
            ['name' => 'Яндекс.Директ'],
            ['name' => 'Google AdWords']
        ]);

        DB::table('tarif')->insert([
            ['name' => 'Тестовый тариф', 
             'description' => 'Первый тестовый тариф. Все для всех бесплатно.',
             'condition' => 'Free'],
            ['name' => 'Второй тариф', 
             'description' => 'Какой-то еще тариф. Снова все для всех бесплатно.',
             'condition' => '0000 р./мес']
        ]);

        DB::table('notes_category')->insert([
            ['name' => 'Заметка'],
            ['name' => 'Запрос контактов компании'],
            ['name' => 'Запрос контактов специалиста'],
            ['name' => 'Просмотр проекта'],
            ['name' => 'Отзыв о компании'],
            ['name' => 'Отзыв о сервисе'],
            ['name' => 'Форма обратной связи']
        ]); 
    }
}
