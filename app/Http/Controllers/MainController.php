<?php

namespace App\Http\Controllers;

use App\Models\Scamer;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function index(Request $request)
    {
        $scammers = Scamer::query();

        if ($request->has('lastname') && !empty($request->input('lastname'))) {
            $lastName = mb_strtolower(trim($request->input('lastname')));

            $scammers->whereLike('lastname', "%$lastName%");
        }
        if ($request->has('firstname') && !empty($request->input('firstname'))) {
            $firstName = mb_strtolower(trim($request->input('firstname')));
            $scammers->whereLike('firstname', "%$firstName%");
        }
        if ($request->has('secondname') && !empty($request->input('secondname'))) {
            $secondName = mb_strtolower(trim($request->input('secondname')));
            $scammers->whereLike('secondname', "%$secondName%");
        }

        //TODO
        if ($request->has('pass_serial') && !empty($request->input('pass_serial'))) {
            $passSerial = mb_strtolower(trim($request->input('pass_serial')));
            $scammers->whereHas('scamer_passes', function($q) use ($passSerial) {
                $q->where('pass_serial', '=', $passSerial);
            });
        }
        if ($request->has('pass_num') && !empty($request->input('pass_num'))) {
            $passNum = mb_strtolower(trim($request->input('pass_num')));
            $scammers->whereHas('scamer_passes', function($q) use ($passNum) {
                $q->where('pass_number', '=', $passNum);
            });
        }
//
        if ($request->has('phone') && !empty($request->input('phone'))) {
            $phone = mb_strtolower(trim($request->input('phone')));
            $scammers->whereHas('scamer_phones', function($q) use ($phone) {
                $q->where('phone', '=', $phone);
            });
        }
//
//        if ($request->has('profile_type') && $request->has('profile_url')) {
//            $profile_type = mb_strtolower(trim($request->input('profile_type')));
//            $profileUrl = mb_strtolower(trim($request->input('profile_url')));
//        }



        $scammers = $scammers->with(['scamer_passes', 'scamer_phones', 'scamer_photos', 'scamer_profiles'])->paginate(10);

        return view('index', compact('scammers'));
    }
}
