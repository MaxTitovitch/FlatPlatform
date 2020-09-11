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
        $dialogs = Dialog::withCount('messages');
        if($viewName === 'dialog.admin-list') {
            $dialogs = $dialogs->where('type', 'Поддержка');
        } else {
            $dialogs = $dialogs->where("first_user_id", Auth::id())->orWhere("second_user_id", Auth::id());
        }

        $dialogs = $dialogs->having('messages_count', '>', 0)->paginate(20);
        return view($viewName, ['dialogs' => $dialogs]);
    }

    public function show(Request $request, $id) {
        $viewName = $request->route()->getName() == "admin-dialog-show" ? 'dialog.admin-show' : 'dialog.user-show';
        $dialog = Dialog::find($id);
        if($dialog != null) {
            if(!($dialog->first_user_id == Auth::id() || $dialog->second_user_id == Auth::id() || Auth::user()->role->name == 'admin')) {
                return redirect()->route('index');
            }
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
            $type = Auth::user()->role->name == 'admin' ? 'Поддержка' : 'Обычный';
            $dialog = Dialog::whereRaw("first_user_id in ($authId, $id)")->orWhereRaw("second_user_id in ($authId, $id)")->where('type', $type)->get();
            if($user == null) {
                $dialog = Dialog::create(['first_user_id' => $authId, 'second_user_id' => $id, 'type' => $type]);
                $dialog->save();
            }
            return redirect()->route($routeName, ['id' => $dialog->id]);
        } else {
            return redirect()->route('index');
        }
    }

    public function support(Request $request) {
        $id = Auth::id();
        $dialog = Dialog::create(['first_user_id' => $id, 'second_user_id' => $id, 'type' => 'Поддержка']);
        $dialog->save();
        return redirect()->route('dialog-show', ['id' => $dialog->id]);
    }

    public function createMessage(MessageRequest $request, $id) {
        $routeName = $request->route()->getName() == "admin-send-message" ? 'admin-dialog-show' : 'dialog-show';
        $dialog = Dialog::find($id);
        if(!$dialog) {
            return redirect()->route('index');
        } else if( !($dialog->first_user_id == Auth::id() || $dialog->second_user_id == Auth::id() || Auth::user()->role->name == 'admin')) {
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
