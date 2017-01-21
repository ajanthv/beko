<body>
A request has recently been made to change your password.

<a href="{!! url('auth/resetVerify?id='.$reminder['user_id'].'&code='. $reminder['code']) !!}" >Reset your password now </a>

</body>