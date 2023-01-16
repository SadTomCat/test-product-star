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
}
