<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Http\Requests\MessageRequest;
use Illuminate\Support\Facades\Storage;

class Message extends Model
{
    protected $fillable = [
        'message', 'type', 'user_id', 'dialog_id',
    ];

    private static function getStatusMessageFlat($status, $isChangeStatus) {
        switch ($status) {
            case 'Создан':
                return $isChangeStatus ? 'Заявка на квартиру возврашена' : 'Создана заявка на квартиру';
            case "Принят":
                return 'Заявка на квартиру принята арендодателем';
            case 'Утверждён':
                return 'Условия сдачи квартиры успешно согласованы сторонами';
            case 'Выполнен':
                return 'Сделка успешно завершена';
            case 'Отменён':
                return 'Заявка на квартиру отклонена арендодателем';
            case 'Отозван':
                return 'Заявка на квартиру отозвана арендатором';
        }
    }

    private static function getStatusMessageService($status, $isChangeStatus) {
        switch ($status) {
            case 'Создан':
                return $isChangeStatus ? 'Заявка на хозработу возвращена' : 'Создана заявка на хозработу';
            case "Принят":
                return 'Заявка на хозработу принята работником';
            case 'Утверждён':
                return 'Условия выполнения хозработы успешно согласованы сторонами';
            case 'Выполнен':
                return 'Сделка успешно завершена';
            case 'Отменён':
                return 'Заявка на хозработу отклонена работником';
            case 'Отозван':
                return 'Заявка на хозработу отозвана арендодателем';
        }
    }

    public function upload(MessageRequest $request) {
        $file = $request->file('file');
        $path = Storage::disk('public')->putFile('message-file', $file);
        $path = '/storage/' . $path;
        return $path;
    }

    public static function createStatusMessage($status, $id, $isFlat, $isChangeStatus = false) {
        Message::create([
            'message' => $isFlat ? self::getStatusMessageFlat($status, $isChangeStatus) : self::getStatusMessageService($status, $isChangeStatus),
            'type' => 'Служебное',
            'user_id' => null,
            'dialog_id' => $id
        ]);
    }

    public static function createPriceMessage($men, $price, $id) {
        Message::create([
            'message' => "$men предлагает изменить стоимость на {$price}₽",
            'type' => 'Служебное',
            'user_id' => null,
            'dialog_id' => $id
        ]);
    }


    public function deleteFile() {
        Storage::delete($this->message);
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function dialog()
    {
        return $this->belongsTo('App\Dialog');
    }
}
