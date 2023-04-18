<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\AccountHolder;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function deposit(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'msisdn' => 'required|string',
            'amount' => 'required|numeric',
            'transref' => 'required|string',
            'clientid' => 'required|string',
        ]);

        // Extract the data from the request
        $msisdn = $request->input('msisdn');
        $amount = $request->input('amount');
        $transref = $request->input('transref');
        $clientid = $request->input('clientid');

        // Perform payment processing logic here
        // You can use the extracted data to process the payment
        // For example, you can call external APIs, perform database operations, etc.

        // Insert payment data into the database using the Payment model
        Payment::create([
            'msisdn' => $msisdn,
            'amount' => $amount,
            'transref' => $transref,
            'clientid' => $clientid,
        ]);

        // Return response indicating successful payment processing
        $response = [
            'status' => 'success',
            'message' => 'Payment processed successfully',
            'data' => [
                'msisdn' => $msisdn,
                'amount' => $amount,
                'transref' => $transref,
                'clientid' => $clientid,
            ],
        ];
        return response()->json($response);
    }

    public function requestPayment(Request $request)
    {
        // Validate the incoming request
        $validatedData = $request->validate([
            'msisdn' => 'required',
            'amount' => 'required',
            'firstname' => 'required',
            'lastname' => 'required',
            'transref' => 'required',
            'clientid' => 'required',
        ]);

        // Check if transref already exists in payments table
        $transref = $validatedData['transref'];
        $existingPayment = Payment::where('transref', $transref)->first();
        if ($existingPayment) {
            // Return error response indicating transref already used
            return response()->json([
                'responsecode' => '-1',
                'responsemsg' => 'Transref: ' . $transref . ' is already used',
                'transref' => $transref,
                'serviceref' => null,
                'comment' => null
            ]);
        }

        // Create a new Payment record
        $payment = new Payment;
        $payment->msisdn = $validatedData['msisdn'];
        $payment->amount = $validatedData['amount'];
        $payment->firstname = $validatedData['firstname'];
        $payment->lastname = $validatedData['lastname'];
        $payment->transref = $validatedData['transref'];
        $payment->clientid = $validatedData['clientid'];
        $payment->save();

        // Return a response indicating success
        return response()->json([
                                'responsecode' => '00',
                                'responsemsg' => 'Payment requested successfully',
                                'transref' => $transref,
                                'serviceref' => null,
                                'comment' => null
                            ]);
    }

    public function getTransactionStatus(Request $request)
    {
        $transref = $request->input('transref');
        $clientid = $request->input('clientid');

        // Check if transref and clientid are provided
        if (empty($transref) || empty($clientid)) {
            return response()->json([
                'responsecode' => '-1',
                'responsemsg' => 'FAILED',
                'transref' => $transref,
                'serviceref' => '0',
                'comment' => null
            ]);
        }

        // Check if transref and clientid exist in the database
        $payment = Payment::where('transref', $transref)
            ->where('clientid', $clientid)
            ->first();

        if (!$payment) {
            return response()->json([
                'responsecode' => '-1',
                'responsemsg' => 'FAILED',
                'transref' => $transref,
                'serviceref' => '0',
                'comment' => null
            ]);
        }

        // Return success response
        return response()->json([
            'responsecode' => '00',
            'responsemsg' => 'Successfully processed transaction.',
            'transref' => $transref,
            'serviceref' => '1679057915',
            'comment' => null
        ]);
    }

    public function getRefund(Request $request)
    {
        $transref = $request->input('transref');
        $clientid = $request->input('clientid');

        // Check if transref and clientid are provided
        if (empty($transref) || empty($clientid)) {
            return response()->json([
                'responsecode' => '-1',
                'responsemsg' => 'FAILED',
                'transref' => $transref,
                'serviceref' => '0',
                'comment' => null
            ]);
        }

        // Check if transref and clientid exist in the database
        $payment = Payment::where('transref', $transref)
            ->where('clientid', $clientid)
            ->first();

        if (!$payment) {
            return response()->json([
                'responsecode' => '-1',
                'responsemsg' => 'FAILED',
                'transref' => $transref,
                'serviceref' => '0',
                'comment' => null
            ]);
        }

        // Return success response
        return response()->json([
            'responsecode' => '00',
            'responsemsg' => 'Operation Successful',
            'transref' => $transref,
            'serviceref' => '1679057915',
            'comment' => null
        ]);
    }

    public function getAvailableAmounToWithdraw(Request $request)
{
    $clientid = $request->input('clientid');

    // Check if clientid exists in Payment table
    $payment = Payment::where('clientid', $clientid)->get();
//    dump($payment);
    if (!$payment) {
        return response()->json([
            'responsecode' => '-1',
            'responsemsg' => 'FAILED',
            'serviceref' => '0',
            'comment' => null
        ]);
    }

    // Get total amount for the given clientid
    $totalAmount = Payment::where('clientid', $clientid)->sum('amount');

    // Return success response with amount and other details
    return response()->json([
        'responsecode' => '00',
        'responsemsg' => 'Successfully processed transaction.',
        'amount' => $totalAmount,
        'serviceref' => '1679057915',
        'comment' => null
    ]);
}

public function getAccountHolderInfo(Request $request)
{
echo "This endpoint was called!!";

    // Retrieve input data
    $clientId = $request->input('clientid');
    $msisdn = $request->input('msisdn');

    // Fetch account holder info from the database
    $accountHolder = AccountHolder::where('client_id', $clientId)
        ->where('msisdn', $msisdn)
        ->first();

    // Check if account holder info is found
    if (!empty($accountHolder)) {
        // Return successful response
        $response = [
            'msisdn' => $accountHolder->msisdn,
            'firstName' => $accountHolder->first_name,
            'surName' => $accountHolder->sur_name,
            'accountholderstatus' => 'ACTIVE',
            'responsecode' => null,
            'responsemsg' => null,
            'personalInformation' => null
        ];
    } else {
        // Return account holder not found response
        $response = [
            'msisdn' => '',
            'firstName' => '',
            'surName' => '',
            'accountholderstatus' => 'ACCOUNTHOLDER_NOT_FOUND',
            'responsecode' => '00',
            'responsemsg' => 'SUCCESS'
        ];
    }

    return response()->json($response);
}

}