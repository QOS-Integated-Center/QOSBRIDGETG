<?php

namespace App\Http\Controllers;

use App\Models\AccountHolder;
use Illuminate\Http\Request;

class AccountHolderController extends Controller
{

    public function addAccountHolder(Request $request)
    {
        // Retrieve input data
        $clientId = $request->input('clientid');
        $msisdn = $request->input('msisdn');
        $firstName = $request->input('firstName');
        $surName = $request->input('surName');

        // Create a new account holder record
        $accountHolder = new AccountHolder();
        $accountHolder->clientid = $clientId;
        $accountHolder->msisdn = $msisdn;
        $accountHolder->firstName = $firstName;
        $accountHolder->surName = $surName;
        $accountHolder->save();

        // Return success response
        $response = [
            'msisdn' => $msisdn,
            'firstName' => $firstName,
            'surName' => $surName,
            'accountholderstatus' => 'ACTIVE',
            'responsecode' => null,
            'responsemsg' => null,
            'personalInformation' => null
        ];

        return response()->json($response, 201); // Use 201 status code for successful resource creation
    }

    public function getAccountHolderInfo(Request $request)
    {

        // Retrieve input data
        $clientId = $request->input('clientid');
        $msisdn = $request->input('msisdn');

        // Fetch account holder info from the database
        $accountHolder = AccountHolder::where('clientid', $clientId)
            ->where('msisdn', $msisdn)
            ->first();

        // Check if account holder info is found
        if (!empty($accountHolder)) {
            // Return successful response
            $response = [
                'msisdn' => $accountHolder->msisdn,
                'firstName' => $accountHolder->firstName,
                'surName' => $accountHolder->surName,
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

    public function deleteAccountHolder(Request $request)
    {
        // Retrieve input data
        $clientId = $request->input('clientid');
        $msisdn = $request->input('msisdn');

        // Find the account holder by client ID and MSISDN
        $accountHolder = AccountHolder::where('clientid', $clientId)
            ->where('msisdn', $msisdn)
            ->first();

        // Check if account holder exists
        if (!empty($accountHolder)) {
            // Delete the account holder
            $accountHolder->delete();

            // Return success response
            $response = [
                'msisdn' => $msisdn,
                'firstName' => '',
                'surName' => '',
                'accountholderstatus' => 'ACCOUNTHOLDER_DELETED',
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

    public function updateAccountHolder(Request $request)
    {
        // Retrieve input data
        $clientId = $request->input('clientid');
        $msisdn = $request->input('msisdn');
        $firstName = $request->input('firstName');
        $surName = $request->input('surName');

        // Find the account holder by client ID and MSISDN
        $accountHolder = AccountHolder::where('clientid', $clientId)
            ->where('msisdn', $msisdn)
            ->first();

        // Check if account holder exists
        if (!empty($accountHolder)) {
            // Update the account holder information
            $accountHolder->firstName = $firstName;
            $accountHolder->surName = $surName;
            $accountHolder->save();

            // Return success response
            $response = [
                'msisdn' => $msisdn,
                'firstName' => $firstName,
                'surName' => $surName,
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
