<?php

    namespace App\Http\Controllers;

    use App\Http\Requests\LoginRequest;
    use App\Http\Requests\RegistrationRequest;
    use App\Mail\EmailConfirmation;
    use App\Models\Creator;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\DB;
    use Illuminate\Support\Facades\Mail;
    use Illuminate\Support\Str;
    use Illuminate\Support\Facades\Hash;
    use Illuminate\Support\Facades\Auth;

    class AuthController extends Controller
    {
        // showRegistrationForm
        public function showRegistrationForm() {
            return view('auth.register');
        }

        // register
        public function register(RegistrationRequest $request){
            $validatedFields = $request->validated();
            $validatedFields['password'] = Hash::make($validatedFields['password']);

            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = date('Ymd') . "_" . Str::random(10) . '.' . $image->getClientOriginalExtension();
                $imagePath = $image->storeAs('uploads/creators_images', $imageName, 'public');
                $validatedFields['image'] = $imagePath;
            } else {
                $validatedFields['image'] = 'uploads/creators_images/profile.png';
            }

            // Create creator
            $creator = Creator::create([
                'creator_name' => $validatedFields['creator_name'],
                'gender' => $validatedFields['gender'],
                'age' => $validatedFields['age'],
                'email' => $validatedFields['email'],
                'password' => $validatedFields['password'],
                'image' => $validatedFields['image'],
                'bio' => $validatedFields['bio'],
            ]);
            $isSent = Mail::to($creator->email)->send(new EmailConfirmation($creator));

            // redirect to login page
            if($isSent) {
                return redirect()
                    ->route('auth.verifyEmail')
                    ->with('success',"We've sent a link to verify your email address. Please check your email and verify your account!");
            } else {
                return back()->with('error', 'Email verification Link Not Sent');
            }
        }

        // showLoginForm
        public function showLoginForm() {
            return view('auth.login');
        }

        // login
        public function login(LoginRequest $request){
            $credentials = $request->validated();

            // Check if user exists
            $creator = Creator::where('email', $credentials['email'])->first();
            if (!$creator) {
                return back()
                    ->with('error', 'No account found with this email');
            }

            // Attempt authentication
            if (Auth::guard('creator')->attempt($credentials)) {
                $request->session()->regenerate();

                return redirect()
                    ->intended(route('posts.index'))  
                    ->with('success', 'You have been logged in successfully');
            }

            return back()
                ->with('error', 'Email or password is incorrect')
                ->withInput($request->only('email')); 
        }

        // verifyEmail
        public function verifyEmail() {
            return view('auth.verifyEmail');
        }

        // confirm Email
        public function confirmEmail(string $hash) {
            $decodedHash = explode('/', base64_decode($hash));
            $id = $decodedHash[0];
            $created_at = $decodedHash[1];

            // find the creator 
            $creator = Creator::findOrFail($id);

            // comparing data
            if ($creator->created_at->toDateTimeString() != $created_at) {
                abort(403);
            } 
            elseif ($creator->email_verified_at != null) {
                abort(403);
            } 
            else {
                $creator->email_verified_at = now();
                $saved = $creator->save();
                // return with message
                if ( $saved ) {
                    $creatorName = $creator->creator_name;
                    return redirect()
                        ->route('auth.loginForm')
                        ->with('success', "$creatorName, Your Email Address Verified Successfully !");
                } else {
                    abort(404);
                }
            } 
        }

        // logout 
        public function logout(Request $request) {
            Auth::guard('creator')->logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect()
                ->route('auth.loginForm')
                ->with('success', 'You have been logged out successfully');
        }
    }
