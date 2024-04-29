<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Password Reset Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines are the default lines which match reasons
    | that are given by the password broker for a password update attempt
    | has failed, such as for an invalid token or invalid new password.
    |
    */
    'password' => 'The password must be at least six characters long, and it must match the confirmation field.',
    'reset' => 'Your password has been reset!',
    'sent' => 'We have e-mailed your password reset link!',
    'token' => 'This password reset token is invalid.',
    'user' => "We can't find a user with that e-mail address.",
    'reset_password' => [
        'subject' => 'Password Change!',
        'message' => 'You received this message to change your password. Please note that the verification code is only valid for 5 minutes. If you did not request a password change, you can ignore this message!',
    ],
];
