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
    private const AUTH_API_URL = 'https://mayflower-neutron-janitor.ngrok-free.dev/dev/auth/login';

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
        ], [
            'nombre_usuario.required' => 'El nombre de usuario es obligatorio.',
            'password.required'       => 'La contraseña es obligatoria.',
        ]);

        try {
            $response = Http::timeout(10)
                ->connectTimeout(5)
                ->asForm() // <-- EL SECRETO ESTÁ AQUÍ: Forzamos formato de formulario clásico
                ->withHeaders([
                    'x-api-key' => 'desa2026',
                    'Accept' => 'application/json'
                ])
                ->post(self::AUTH_API_URL, [
                    // Enviamos tanto la versión en inglés como en español para asegurar
                    'username'       => $credentials['nombre_usuario'], 
                    'nombre_usuario' => $credentials['nombre_usuario'], 
                    'password'       => $credentials['password'],
                ]);
        } catch (ConnectionException $e) {
            Log::error('SGI Auth: timeout o fallo de conexión.', ['error' => $e->getMessage()]);
            return back()
                ->withInput($request->only('nombre_usuario'))
                ->withErrors(['nombre_usuario' => 'No se pudo conectar con el servidor.']);
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

        if ($response->status() === 401) {
            return back()
                ->withInput($request->only('nombre_usuario'))
                ->withErrors(['nombre_usuario' => 'Usuario o contraseña incorrectos.']);
        }

        // Mostrar el error crudo del servidor
     if ($response->status() === 422) {
         return back()
             ->withInput($request->only('nombre_usuario'))
             ->withErrors(['nombre_usuario' => 'Error crudo de Oscar: ' . $response->body()]);
     }

        if ($response->status() === 500) {
            return back()
                ->withInput($request->only('nombre_usuario'))
                ->withErrors(['nombre_usuario' => 'El servidor de autenticación presentó un error interno.']);
        }

        return back()
            ->withInput($request->only('nombre_usuario'))
            ->withErrors(['nombre_usuario' => 'Respuesta inesperada del servidor (' . $response->status() . ').']);
    }

    public function destroy(Request $request): RedirectResponse
    {
        $request->session()->flush();
        $request->session()->regenerate();
        return redirect()->route('login');
    }
}   