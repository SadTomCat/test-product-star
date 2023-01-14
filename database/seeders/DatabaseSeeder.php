<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use App\Models\Course;
use App\Models\Lesson;
use App\Models\LessonUser;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Collection;

class DatabaseSeeder extends Seeder
{
    private const COUNT_USERS             = 2000;
    private const COUNT_ADMINS            = 4;
    private const COUNT_LESSONS           = 27;
    private const COMPLETED_LESSONS_RANGE = [1, 20];

    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        /** @var Course $course */
        $course = Course::factory()->create();

        User::factory(self::COUNT_ADMINS)->admin()->create();

        /** @var Collection<int> $lessonIds */
        $lessonIds = Lesson::factory(self::COUNT_LESSONS)->course($course->id)->create()->pluck('id');


        User::factory(self::COUNT_USERS)->user()->afterCreating(function (User $user) use ($lessonIds) {
            $countCompletedLessons = random_int(self::COMPLETED_LESSONS_RANGE[0], self::COMPLETED_LESSONS_RANGE[1]);

            $lessonIds->random($countCompletedLessons)->each(
                fn($lessonId) => LessonUser::factory()->completed()->create([
                    'user_id'   => $user->id,
                    'lesson_id' => $lessonId,
                ])
            );
        })->create();
    }
}
