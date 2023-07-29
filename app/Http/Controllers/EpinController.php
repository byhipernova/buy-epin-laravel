<?php

namespace App\Http\Controllers;

use App\Models\Epin;

class EpinController extends Controller
{

    /* Herhangi bir user istek attığında epin status değerini in process olarak ayarlıyoruz isteği atan user için user_id'yi unique oluşturduğum için user_id
    kullandım fakat gerçek hayat senaryosunda process_id kullanılması daha iyi olacaktır error handling ile işlemlerde bir sorun çıkması durumunda epini
    tekrar satışa sunmalıyız. Bu çözümü kullanmamdaki sebep mysqlin işlemleri sırayla yapması birden çok kullanıcı aynı anda epin isteğinde bulunsa bile
    her kullanıcıya unique bi epin rezerve edilecek. Bu çözüm dışında lockForUpdate methodunu da gördüm fakat en mantıklı ve kolay çözüm bu bence */
    function buyEpin()
    {
        try {
            
            $userId = uniqid();
            $update = Epin::where('status', 'unused')->limit(1)->update(['status' => 'in process', 'user_id' => $userId]);

            if ($update) {

                try {

                    if ($this->userCanBuyEpin()) {

                        Epin::where(['user_id' => $userId, 'status' => 'in process'])->update(['status' => 'used']);
                        return Epin::where(['user_id' => $userId, 'status' => 'used'])->orderBy('id', 'desc')->first();

                    } else {

                        Epin::where(['user_id' => $userId, 'status' => 'in process'])->update(['status' => 'unused', 'user_id' => null]);
                        return response()->json([
                            'message' => 'User can not buy epin',
                        ], 400);

                    }

                } catch (QueryException $e) {

                    Epin::where(['user_id' => $userId, 'status' => 'in process'])->update(['status' => 'unused', 'user_id' => null]);
                    return response()->json([
                        'message' => 'Error occurred while processing the request. message: ' . $e->getMessage(),
                    ], 500);

                }

            } else {

                return response()->json([
                    'message' => 'No epin available',
                ], 404);

            }
        } catch (QueryException $e) {

            return response()->json([
                'message' => 'Error occurred while processing the request. message: ' . $e->getMessage(),
            ], 500);

        }
    }

    function userCanBuyEpin()
    {
        // user işlemleri
        return true;
    }

}
