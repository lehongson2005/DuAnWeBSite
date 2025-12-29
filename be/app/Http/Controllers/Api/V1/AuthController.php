<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserProfile;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

class AuthController extends Controller
{
    /**
     * Redirect the user to the provider's authentication page.
     */
    public function redirectToProvider(string $provider)
    {
        $this->validateProvider($provider);
        return Socialite::driver($provider)->stateless()->redirect();
    }

    /**
     * Obtain the user information from the provider.
     */
    public function handleProviderCallback(string $provider)
    {
        $this->validateProvider($provider);

        try {
            $socialUser = Socialite::driver($provider)->stateless()->user();
        } catch (Exception $e) {
            return response()->json(['error' => 'Invalid credentials provided.'], 422);
        }

        // Find or create the user
        $user = DB::transaction(function () use ($socialUser, $provider) {
            $user = User::where('email', $socialUser->getEmail())->first();

            if ($user) {
                // Update user with provider info if needed
                $user->provider_id = $socialUser->getId();
                $user->provider_name = $provider;
                $user->save();
                return $user;
            }

            // Create new user and profile
            $newUser = User::create([
                'name' => $socialUser->getName(),
                'email' => $socialUser->getEmail(),
                'provider_id' => $socialUser->getId(),
                'provider_name' => $provider,
                'password' => bcrypt(Str::random(16)) // Random password as it's not used
            ]);

            UserProfile::create([
                'user_id' => $newUser->id,
                'full_name' => $socialUser->getName(),
                'avatar' => $socialUser->getAvatar(),
            ]);

            return $newUser;
        });

        // Create a token for the user
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'user' => $user,
            'token' => $token,
            'token_type' => 'Bearer',
        ]);
    }

    /**
     * Validate the provider.
     */
    protected function validateProvider(string $provider)
    {
        if (!in_array($provider, ['facebook', 'google'])) {
            abort(404, 'Provider not supported.');
        }
    }
}