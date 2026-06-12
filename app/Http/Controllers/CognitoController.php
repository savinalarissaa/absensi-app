<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use App\Models\Dosen;

use Aws\CognitoIdentityProvider\CognitoIdentityProviderClient;

class CognitoController extends Controller{
    public function login(Request $request){
        $client = new CognitoIdentityProviderClient([
            'region'  => env('us-east-1'),
            'version' => 'latest'
        ]);

        try {

            $result = $client->initiateAuth([
                'AuthFlow' => 'USER_PASSWORD_AUTH',
                'ClientId' => env('AWS_COGNITO_CLIENT_ID'),
                'AuthParameters' => [
                    'USERNAME' => $request->email,
                    'PASSWORD' => $request->password,
                ]
            ]);

            session([
                'access_token' => $result['AuthenticationResult']['AccessToken']
            ]);

            return redirect('/dashboard');

        } catch (\Exception $e) {

            return back()
                ->withErrors([
                    'login' => 'Email atau password salah'
                ]);
        }
    }

    public function cognitoCallback(Request $request)
    {
        $response = Http::asForm()->post(
            'https://us-east-15ltk3i0xd.auth.us-east-1.amazoncognito.com/oauth2/token',
            [
                'grant_type' => 'authorization_code',
                'client_id' => env('COGNITO_CLIENT_ID'),
                'client_secret' => env('COGNITO_CLIENT_SECRET'),
                'code' => $request->code,
                'redirect_uri' => 'http://127.0.0.1:8000/dosen'
            ]
        );

        $tokens = $response->json();

        $idToken = $tokens['id_token'];

            $parts = explode('.', $idToken);

        $payload = json_decode(
            base64_decode(strtr($parts[1], '-_', '+/')),
            true
        );

        $email = $payload['email'];

            $dosen = Dosen::where(
            'email',
            $email
        )->first();

        if (!$dosen) {
            abort(403, 'Dosen tidak ditemukan');
        }

        dd($payload);

        return redirect('/dosen');
    }
}