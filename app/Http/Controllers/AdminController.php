<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\DB;

/**
 * Class AdminController
 *
 * @package App\Http\Controllers
 */
class AdminController extends Controller
{
    public function users()
    {
        $users = DB::table('users')->paginate(10);

        return view(
            'users.index',
            [
                'users' => $users
            ]
        );
    }

    public function boards()
    {
        $boards = DB::table('boards')->paginate(10);

        return view(
            'boards.index',
            [
                'boards' => $boards
            ]
        );
    }


}
