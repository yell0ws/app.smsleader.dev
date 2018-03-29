<?php

namespace App\Http\Controllers;

use Auth;
use App\Locker;
use App\Payment;
use App\Http\Requests\Widget\LockerRequest;
use Illuminate\Http\Request;

class WidgetController extends Controller
{
     public function __construct()
    {
        $this->middleware('auth');
    }

    public function getPlayerList()
    {
        return view('widget.player.list', [
        	'publicPrograms' => NULL,
        ]);
    }

    public function getPlayerNew(){
        $mo = Payment::active(true)->where('type', 'mo')->By('rate', 'desc')->get();
        $mt = Payment::active(true)->where('type', 'mt')->By('rate', 'desc')->get();

        return view('widget.player.new',[
            'mo' => $mo,
            'mt' => $mt,
        ]);
    }

    public function postPlayerNew(){

    }

    public function getPlayerEdit($id){

    }

    public function postPlayerEdit($id){

    }

    public function getPlayerDelete($id){

    }

    public function getLockerList()
    {

        $locker = Auth::user()->locker()->orderby('id')->paginate(20);

        return view('widget.locker.list', [
        	'lockers' => $locker,
        ]);
    }

    public function getLockerNew(){
        
        $mo = Payment::active(true)->where('type', 'mo')->By('rate', 'desc')->get();
        $mt = Payment::active(true)->where('type', 'mt')->By('rate', 'desc')->get();

        return view('widget.locker.new',[
            'mo' => $mo,
            'mt' => $mt,
        ]);
    }

    public function postLockerNew(LockerRequest $request){

        dd($request);

        foreach($request->get('payment') as $key => $id){
            
            $payment = Payment::where('id', $id)->first();

            if ($payment) {
               if (!$payment->active) {
                  return redirect()->back()->with('error', 'Model płatności '. $payment->name .' jest niedostępny! Wybierz spośród innych dostępnych modeli płatności.');
               }
            }
        }

        $color_background = $request->get('color-background') ? str_replace('#', '', $request->get('color-background')) : '000000';
        $color_button = $request->get('color-button') ? str_replace('#', '', $request->get('color-button')) : '4caf50';
        $text_intro = $request->get('text_intro') ? trim($request->get('text_intro')) : 'Dostęp zablokowany! Wykup premium.';
        $text_button = $request->get('text_button') ? trim($request->get('text_button')) : 'Odblokuj';
        $auto_rule = $request->get('auto-rule') ? true : false;

        $create = Locker::create([
            'user_id' => Auth::user()->id,
            'name' => trim($request->get('name')),
            'domain' => $request->get('domain'),
            'payment_model' => $request->get('payment'),
            'redirect' => $request->get('redirect'),
            'color_background' => $color_background,
            'color_button' => $color_button,
            'text_intro' => $text_intro,
            'text_button' => $text_button,
            'auto_rule' => $auto_rule,
        ]);

        if ($create) {
            alert()->success('OK','OK');
            return redirect()->route('widget.locker');
        }

        return redirect()->route('widget.locker')->with('error','Wystapil nieoczekiwany błąd! Spróbuj ponownie za chwilę.');
    }

    public function getLockerEdit($id){

        $locker = Locker::where('id', $id)->where('user_id', Auth::user()->id)->first();

        if (!$locker) return redirect()->route('widget.locker');

        $mo = Payment::Active()->where('type', 'mo')->By('rate', 'desc')->get();
        $mt = Payment::Active()->where('type', 'mt')->By('rate', 'desc')->get();

        return view('widget.locker.edit',[
            'mo' => $mo,
            'mt' => $mt,
            'locker' => $locker,
        ]);
    }

    public function postLockerEdit($id, Request $request){

        $locker = Locker::where('id', $id)->where('user_id', Auth::user()->id)->first();

        if (!$locker) return redirect()->route('widget.locker');

        $color_background = $request->get('color_background') ? str_replace('#', '', $request->get('color_background')) : '000000';
        $color_button = $request->get('color_button') ? str_replace('#', '', $request->get('color_button')) : '4caf50';
        $text_intro = $request->get('text_intro') ? trim($request->get('text_intro')) : 'Dostęp zablokowany! Wykup premium.';
        $text_button = $request->get('text_button') ? trim($request->get('text_button')) : 'Odblokuj';
        $auto_rule = $request->get('auto_rule') ? true : false;

        $update = $locker->update([
            'name' => trim($request->get('name')),
            'domain' => $request->get('domain'),
            'payment_model' => $request->get('payment'),
            'redirect' => $request->get('redirect'),
            'color_background' => $color_background,
            'color_button' => $color_button,
            'text_intro' => $text_intro,
            'text_button' => $text_button,
            'auto_rule' => $auto_rule,
        ]);

        if ($update) {
            alert()->success('OK','Pomyślnie wylogowano');
            return redirect()->route('widget.locker');
        }

        return redirect()->route('widget.locker')->with('error','Wystapil nieoczekiwany błąd! Spróbuj ponownie za chwilę.');

    }

    public function getLockerDelete($id){

        $locker = Locker::where('id', $id)->where('user_id', Auth::user()->id)->first();

        if (!$locker) return redirect()->route('widget.locker');

        $locker->delete();

        alert()->success('Widget został usunięty pomyślnie!', 'Usunięto widget');
        return redirect()->route('widget.locker');
    }

    public function getDownloadList()
    {
        return view('widget.download.list', [
        	'publicPrograms' => NULL,
        ]);
    }

    public function getDownloadNew(){

    }

    public function postDownloadNew(){
        
    }

    public function getDownloadEdit($id){
        dd($id);
    }

    public function postDownloadEdit($id){
        dd($id);
    }

    public function getDownloadDelete($id){
        dd($id);
    }
}
