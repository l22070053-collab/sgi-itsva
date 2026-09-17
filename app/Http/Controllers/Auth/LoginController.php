<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

class LoginController extends Controller
{
    public function create(Request $request): View|RedirectResponse
    {
        if ($request->session()->has('access_token')) {
            return redirect()->route('dashboard');
        }
        return view('auth.login');
    }

    public function store(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'nombre_usuario' => ['required', 'string', 'max:255'],
            'password'       => ['required', 'string'],
        ]);

        try {
            $response = Http::timeout(10)
                ->connectTimeout(5)
                ->asForm()
                ->withHeaders([
                    'x-api-key' => env('API_SGI_KEY'),
                    'Accept'    => 'application/json'
                ])
                ->post(env('API_SGI_URL'), [
                    'username'       => $credentials['nombre_usuario'],
                    'nombre_usuario' => $credentials['nombre_usuario'],
                    'password'       => $credentials['password'],
                ]);
        } catch (ConnectionException $e) {
            return back()->withErrors(['nombre_usuario' => 'No se pudo conectar con el servidor.']);
        }

        if ($response->successful()) {
            $data = $response->json();
            $request->session()->regenerate();
            $request->session()->put([
                'access_token' => $data['access_token'] ?? null,
                'id'           => $data['id'] ?? null,
                'username'     => $data['username'] ?? null,
                'permissions'  => $data['permissions'] ?? [],
            ]);
            return redirect()->intended(route('dashboard'));
        }

        return back()->withErrors(['nombre_usuario' => 'Credenciales incorrectas o error en API.']);
    }

    public function destroy(Request $request): RedirectResponse
    {
        $request->session()->flush();
        $request->session()->regenerate();
        return redirect()->route('login');
    }
}