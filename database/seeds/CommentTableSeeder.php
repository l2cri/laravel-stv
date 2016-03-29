<?php

use Illuminate\Database\Seeder;

class CommentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $loreum = 'lorem ipsum dolor sit amet';
        $user_id = 4;

        for ($i = 1; $i <= 30; $i++){
            $comment = new App\Models\Comment;
            $comment->text = $loreum;
            $comment->user_id = 1;
            $comment->commentable_id = 45;
            $comment->commentable_type = 'App\Models\Product\Product';

            $comment->save();
        }
    }
}
