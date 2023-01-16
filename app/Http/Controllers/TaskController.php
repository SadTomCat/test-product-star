<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Enums\RolesEnum;
use Illuminate\Support\Facades\DB;

class TaskController extends Controller
{
    public function task1()
    {
        $userQuery = DB::table('users')
                       ->select('users.id', 'first_name', 'last_name', 'email')
                       ->selectRaw('TRUNCATE(count(lessons.id) / (SELECT COUNT(*) FROM lessons) * 100, 2) as process')
                       ->leftJoin('lesson_user', 'users.id', 'lesson_user.user_id')
                       ->leftJoin('lessons', 'lessons.id', 'lesson_user.lesson_id')
                       ->where('users.role', RolesEnum::User->value)
                       ->groupBy('users.id');

        $resQuery = DB::table(DB::raw("({$userQuery->toSql()}) as user"))
                      ->selectRaw('*, DENSE_RANK() OVER (ORDER BY process DESC, id) user_rank')
                      ->mergeBindings($userQuery);

        $pagination = $resQuery->paginate(10)->onEachSide(1);

        return Inertia::render('Task1', ['pagination' => $pagination]);
    }

    public function task2()
    {
        $query = DB::table('users')
                   ->select('users.id', 'first_name', 'last_name', 'email')
                   ->selectRaw('COUNT(lessons.id) as viewed_lessons')
                   ->leftJoin('lesson_user', 'users.id', 'lesson_user.user_id')
                   ->leftJoin('lessons', 'lessons.id', 'lesson_user.lesson_id')
                   ->where('users.role', RolesEnum::User->value)
                   ->groupBy('users.id')
                   ->orderBy('viewed_lessons', 'desc')
                   ->orderBy('users.id');

        $pagination = $query->paginate(10)->onEachSide(1);

        return Inertia::render('Task2', ['pagination' => $pagination]);
    }

    public function task3()
    {
        $query = DB::table('lessons')
                   ->select('lessons.id', 'lessons.title as lesson', 'courses.title as course')
                   ->selectRaw('COUNT(lesson_user.id) as viewed')
                   ->join('lesson_user', 'lessons.id', 'lesson_user.lesson_id')
                   ->join('courses', 'course_id', 'courses.id')
                   ->groupBy('lessons.id')
                   ->orderBy('viewed', 'desc')
                   ->orderBy('lessons.id');

        $pagination = $query->paginate(10)->onEachSide(1);

        return Inertia::render('Task3', ['pagination' => $pagination]);
    }
}
