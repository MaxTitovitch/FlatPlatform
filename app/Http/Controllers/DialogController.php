<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Dialog;
use App\User;
use Illuminate\Support\Facades\Auth;
use App\Message;
use App\Http\Requests\MessageRequest;

class DialogController extends Controller
{
    public function index(Request $request) {
        $viewName = $request->route()->getName() == "admin-dialog-list" ? 'dialog.admin-list' : 'dialog.user-list';
        $dialogs = Dialog::with('messages')->withCount('messages')->having('messages_count', '>', 0)->get();
        return view($viewName, ['dialogs' => $dialogs]);
    }

    public function show(Request $request, $id) {
        $viewName = $request->route()->getName() == "admin-dialog-show" ? 'dialog.admin-show' : 'dialog.user-show';
        $dialog = Dialog::find($id);
        if($dialog != null) {
            return view($viewName, ['dialog' => $dialog]);
        } else {
            return redirect()->route('index');
        }
    }

    public function create(Request $request, $id) {
        $routeName = $request->route()->getName() == "admin-dialog-create" ? 'admin-dialog-show' : 'dialog-show';
        $user = User::find($id);
        if($user != null) {
            $authId = Auth::id(); $id = $user->id;
            $dialog = Dialog::whereRaw("first_user_id in ($authId, $id)")->whereRaw("second_user_id in ($authId, $id)")->where('type', 'Обычный')->get();
            if($user == null) {
                $dialog = Dialog::create(['first_user_id' => $authId, 'second_user_id' => $id, 'type' => 'Обычный']);
                $dialog->save();
            }
            return redirect()->route($routeName, ['id' => $dialog->id]);
        } else {
            return redirect()->route('index');
        }
    }

    public function createMessage(MessageRequest $request, $id) {
        $routeName = $request->route()->getName() == "admin-send-message" ? 'admin-dialog-show' : 'dialog-show';
        if(!Dialog::find($id)) {
            return redirect()->route('index');
        }
        if($request->file) {
            $type = 'Файл';
            $message = '';
        } else {
            $type = 'Текст';
            $message = $request->message;
        }
        $message = Message::create([
            'message' => $message,
            'type' => $type,
            'user_id' => Auth::id(),
            'dialog_id' => $id
        ]);
        $message->upload($request); $message->save();
        return redirect()->route($routeName, ['id' => $message->dialog->id]);
    }

    public function removeMessage(Request $request, $id) {
        $routeName = $request->route()->getName() == "admin-remove-message" ? 'admin-dialog-show' : 'dialog-show';
        $message = Message::find($id);
        if($message != null) {
            if(Auth::user()->role->name === 'admin' || $message->user->id === Auth::id()) {
                $message->deleteFile();
                $message->delete();
                return redirect()->route($routeName, ['id' => $message->dialog->id]);
            } else {
                return redirect()->route('index');
            }
        } else {
            return redirect()->route('index');
        }
    }


}
