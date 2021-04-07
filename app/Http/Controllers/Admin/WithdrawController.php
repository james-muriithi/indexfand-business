<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Helpers\B2cMpesa;
use App\Http\Requests\StoreWithdrawRequest;
use App\Models\Business;
use App\Models\Withdraw;
use App\Models\WithdrawRequest;
use Gate;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class WithdrawController extends Controller
{
    const TRANSACTION_COST = 0;

    public function index()
    {
        abort_if(Gate::denies('withdraw_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $withdraws = Withdraw::with(['business'])->get();
        $businesses = Auth::user()->userBusinesses;

        return view('admin.withdraws.index', compact('withdraws', 'businesses'));
    }

    public function create()
    {
        abort_if(Gate::denies('withdraw_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $businesses = Auth::user()->userBusinesses;

        return view('admin.withdraws.create', compact('businesses'));
    }

    public function store(StoreWithdrawRequest $request)
    {
        $business = Business::find($request->input('business_id'));

        $amount = intval($request->input('amount'));
        $phone = $request->input('phone');

        if (!$business || $business->owner != Auth::id()){
            return redirect()->route('admin.withdraws.index')
                ->with('error', 'Business does not exists');
        }

        if ($business->balance < $amount + self::TRANSACTION_COST){
            return redirect()->route('admin.withdraws.index')
                ->with('error', 'You do not have enough balance to withdraw Ksh. '.$amount);
        }

        if (WithdrawRequest::isDuplicateWithdraw($business->id, $amount)){
            return redirect()->route('admin.withdraws.index')
                ->with('error', 'We were unable to process your request because a similar transaction is underway. Please wait while we complete your initial request.');
        }

        //if all checks passes
        $response = $this->mpesaWithdraw($amount, $phone);

        $temp = json_decode($response, true);

        if (isset($temp['ResponseCode']) && $temp['ResponseCode'] == 0){
            WithdrawRequest::create([
                'ConversationID' => $temp['ConversationID'],
                'OriginatorConversationID' => $temp['OriginatorConversationID'],
                'amount' => $amount,
                'business_id' => $business->id,
            ]);

            return $response;

//            Withdraw::create($request->all());

            return redirect()->route('admin.withdraws.index')
                ->with('success', 'Your transaction of Ksh. '.$amount .' from '.$business->name.' is being processed.');
        }else{
            return redirect()->route('admin.withdraws.index')
                ->with('error', 'An unexpected error occurred, please try again later.');
        }

    }

    public function show(Withdraw $withdraw)
    {
        abort_if(Gate::denies('withdraw_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $withdraw->load('business');

        return view('admin.withdraws.show', compact('withdraw'));
    }

    private function mpesaWithdraw($amount, $phone)
    {
        $mpesa= new B2cMpesa();
        $InitiatorName = env('INITIATOR');
        $SecurityCredential = B2cMpesa::generateSecurityCredential();
        $CommandID='BusinessPayment';
        $Amount= $amount;
        $PartyA='3014653';
        $PartyB= $phone;
        $Remarks = 'withdrawal';
        $QueueTimeOutURL = env('APP_ENV') == 'local' ?
            'https://018799a8e071.ngrok.io/api/timeout' : route('api.b2ctimeout');
        $ResultURL= env('APP_ENV') == 'local' ?
            'https://018799a8e071.ngrok.io/api/b2c_response/'.env('CALLBACK_KEY') : route('api.b2cresponse', env('CALLBACK_KEY'));
        $Occasion = '';

        return $mpesa::b2c($InitiatorName, $SecurityCredential, $CommandID, $Amount, $PartyA,
            $PartyB, $Remarks, $QueueTimeOutURL, $ResultURL, $Occasion);
    }
}
