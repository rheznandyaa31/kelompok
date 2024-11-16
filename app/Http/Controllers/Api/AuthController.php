<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Laravel\Sanctum\PersonalAccessToken;
use Illuminate\Support\Facades\Mail;
use App\Mail\VerificationCodeMail;
use Illuminate\Support\Str;
use App\Models\VerificationCode;
use Exception;

class AuthController
{
    /**
     * Handle the logout request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    // a. login
    public function login(Request $request)
    {
        try {
            $request->validate([
                'username' => 'required|numeric',
                'password' => 'required|string',
            ]);

            $user = User::where('username', $request->username)->first();

            if (!$user) {
                Log::info('Login gagal: Username tidak ditemukan', [
                    'username' => $request->username,
                ]);
                return response()->json(['message' => 'Username tidak ditemukan'], 404);
            }

            Log::info('Attempting login', [
                'username' => $request->username,
                'input_password' => $request->password,
                'hashed_password' => $user->password,
            ]);

            Log::info("Hashing password", [
                'request_password' => $request->password,
                'user_password' => $user->password,
                'return_hashing' => Hash::check($request->password, $user->password)
            ]);

            if (Hash::check($request->password, $user->password)) {
                Log::info('Login berhasil untuk username: ' . $request->username);
                $token = $user->createToken('auth_token')->plainTextToken;

                return response()->json([
                    'status' => 200,
                    'message' => 'Login users successfully',
                    'data' => [
                        'token' => $token,
                        'role' => $user->role,
                        'users' => [
                            'name' => $user->name,
                            'username' => $user->username,
                            'telp' => $user->telp,
                            'alamat' => $user->alamat,
                            'image' => url($user->image),
                            'semester' => $user->semester,
                            'prodi' => $user->prodi,
                        ],
                    ],
                ]);
            } else {
                Log::info("Password salah untuk username: " . $request->username);
                return response()->json(['message' => 'Invalid credentials'], 401);
            }
        } catch (Exception $e) {
            Log::error('Error during login: ' . $e->getMessage());
            return response()->json(['message' => 'Login failed'], 500);
        }
    }

    // b. Forgot Password
    public function sendEmailVerification(Request $request)
    {
        try {
            $request->validate(['email' => 'required|email']);
            $user = User::where('email', $request->email)->first();

            if (!$user) {
                return response()->json(['status' => 404, 'message' => 'Email not found'], 404);
            }

            $verificationCode = rand(100000, 999999);
            VerificationCode::updateOrCreate(
                ['email' => $request->email],
                ['verification_code' => $verificationCode]
            );

            Mail::to($user->email)->send(new VerificationCodeMail($verificationCode));

            return response()->json([
                'status' => 200,
                'message' => 'Check your email for code verification'
            ]);
        } catch (Exception $e) {
            Log::error('Error during sending verification email: ' . $e->getMessage());
            return response()->json(['message' => 'Failed to send email verification'], 500);
        }
    }

    // c. Verification Code Email
    public function verifyCode(Request $request)
    {
        try {
            Log::debug('Verifying code', $request->all());

            $request->validate([
                'verification_code' => 'required|numeric'
            ]);

            // verifikasi berdasarkan verification_code
            $verification = VerificationCode::where('verification_code', $request->verification_code)->first();

            if (!$verification) {
                return response()->json([
                    'status' => 404,
                    'message' => 'Verification code not found.'
                ], 404);
            }

            // Jika kode verifikasi ditemukan
            return response()->json([
                'status' => 200,
                'message' => 'Email Verification Successfully'
            ], 200);
        } catch (\Exception $e) {
            Log::error('Error during verification code: ' . $e->getMessage());
            return response()->json([
                'status' => 500,
                'message' => 'Verification failed'
            ], 500);
        }
    }

    // d. Reset Password
    public function resetPassword(Request $request)
    {
        try {
            $request->validate([
                'email' => 'required|email',
                'verification_code' => 'required|string',
                'new_password' => 'required|string|min:8'
            ]);

            $verification = VerificationCode::where('email', $request->email)
                ->where('verification_code', $request->verification_code)
                ->first();

            if (!$verification) {
                return response()->json(['status' => 400, 'message' => 'Invalid verification code or email']);
            }

            $user = User::where('email', $request->email)->first();

            if (!$user) {
                return response()->json(['status' => 404, 'message' => 'User not found']);
            }

            $user->password = $request->new_password;
            $user->save();

            $verification->delete();

            Log::info('Password berhasil diubah untuk email: ' . $request->email);

            return response()->json(['status' => 200, 'message' => 'Reset password successfully']);
        } catch (Exception $e) {
            Log::error('Error during password reset: ' . $e->getMessage());
            return response()->json(['message' => 'Password reset failed'], 500);
        }
    }

    // update password
    // public function updatePassword(Request $request)
    // {
    //     try {
    //         // Validasi input
    //         $request->validate([
    //             'username' => 'required|string',
    //             'new_password' => 'required|string|min:8',
    //         ]);

    //         // Temukan pengguna berdasarkan username
    //         $user = User::where('username', $request->username)->first();

    //         // Periksa apakah pengguna ditemukan
    //         if (!$user) {
    //             return response()->json(['message' => 'Pengguna tidak ditemukan.'], 404);
    //         }

    //         // Hash password baru
    //         $hashedPassword = Hash::make($request->new_password);

    //         // Simpan password baru ke pengguna
    //         $user->password = $hashedPassword;
    //         $user->save(); // Pastikan ini sukses

    //         // Cek apakah password baru tersimpan dengan benar
    //         if (Hash::check($request->new_password, $user->password)) {
    //             return response()->json(['message' => 'Password berhasil diperbarui dan cocok!'], 200);
    //         } else {
    //             return response()->json(['message' => 'Gagal memperbarui password.'], 500);
    //         }
    //     } catch (Exception $e) {
    //         // Log error untuk analisis lebih lanjut
    //         Log::error('Error updating password: ' . $e->getMessage());
    //         return response()->json(['message' => 'Terjadi kesalahan saat memperbarui password.'], 500);
    //     }
    // }


    // e. Logout
    public function logout(Request $request)
    {
        \Log::info('Token User:', ['token' => $request->bearerToken()]);

        try {
            // Pastikan user terautentikasi
            if ($request->user()) {
                // Hapus token pengguna yang sedang login
                $userId = $request->user()->id; // Menyimpan ID user untuk log
                $request->user()->currentAccessToken()->delete();

                // Log informasi keberhasilan logout
                Log::info('User logged out successfully', ['user_id' => $userId]);

                return response()->json([
                    'status' => 200,
                    'message' => 'Logout user successfully'
                ]);
            }

            // Log jika user tidak terautentikasi
            Log::warning('Unauthenticated user attempted to logout', ['ip' => $request->ip()]);

            return response()->json([
                'status' => 401,
                'message' => 'Unauthenticated'
            ], 401);
        } catch (\Exception $e) {
            // Log detail error saat logout gagal
            Log::error('Error during logout: ' . $e->getMessage(), [
                'user_id' => $request->user() ? $request->user()->id : null,
                'ip' => $request->ip(),
                'error_trace' => $e->getTraceAsString()
            ]);

            return response()->json(['message' => 'Logout failed'], 500);
        }
    }
}
