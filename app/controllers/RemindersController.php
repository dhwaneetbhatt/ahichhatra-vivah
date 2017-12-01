<?php

/**
 * Autogenerated Controller for Password Reset functionality
 */
class RemindersController extends Controller
{

    /**
     * Display the password reminder view.
     *
     * @return Response
     */
    public function getRemind()
    {
        $siteKey = Config::get('app.recaptcha.site_key');
        return View::make('password.remind', array('siteKey' => $siteKey));
    }

    /**
     * Handle a POST request to remind a user of their password.
     *
     * @return Response
     */
    public function postRemind()
    {
        // verifying the captcha
        $secretKey = Config::get('app.recaptcha.secret_key');
        $recaptcha = new \ReCaptcha\ReCaptcha($secretKey);
        $resp = $recaptcha->verify(Input::get('g-recaptcha-response'), $_SERVER['REMOTE_ADDR']);
        if (!$resp->isSuccess())
        {
            return Redirect::back()
                    ->with('message', 'Captcha validation failed. Please try again.')
                    ->withInput();
        }
        
        $response = Password::remind(Input::only('email'), function($message)
        {
            $message->subject('Ahichhatra Vivah Password Reset');
        });
        switch ($response)
        {
            case Password::INVALID_USER:
                return Redirect::back()->with('message', Lang::get($response));

            case Password::REMINDER_SENT:
                return Redirect::back()->with('success', 'Reset mail sent! Please check your email.');
        }
    }

    /**
     * Display the password reset view for the given token.
     *
     * @param  string  $token
     * @return Response
     */
    public function getReset($token = null)
    {
        if (is_null($token)) App::abort(404);

        return View::make('password.reset')->with('token', $token);
    }

    /**
     * Handle a POST request to reset a user's password.
     *
     * @return Response
     */
    public function postReset()
    {
        $credentials = Input::only(
            'email', 'password', 'password_confirmation', 'token'
        );

        $response = Password::reset($credentials, function($user, $password)
        {
            $user->password = Hash::make($password);

            $user->save();
        });

        switch ($response)
        {
            case Password::INVALID_PASSWORD:
            case Password::INVALID_TOKEN:
            case Password::INVALID_USER:
                return Redirect::back()->with('message', Lang::get($response));

            case Password::PASSWORD_RESET:
                return Redirect::to('/login')->with('success', 'Login with new password');
        }
    }

}
