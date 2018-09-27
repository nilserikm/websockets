<?php

namespace App\Http\Controllers;

use App\Checklist;
use Illuminate\Http\Request;
use App\Events\ChecklistStatusToggle;
use Illuminate\Support\Facades\Auth;

class ChecklistsController extends Controller
{
    public function toggle(Request $request)
    {
        $user = Auth::user();
        $checklist = Checklist::find($request->input('id'));
        $checked = $request->input('checked');

        $checklist->checked = $checked;
        $checklist->save();

        broadcast(new ChecklistStatusToggle($user, $checklist))->toOthers();

        return ['status' => 'Checkpoint checked'];
    }
}
