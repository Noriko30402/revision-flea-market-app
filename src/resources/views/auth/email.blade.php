@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ }}">
@endsection

@section('content')

<h1>Email Verification</h1>
    <p>Please click the button below to verify your email address:</p>
    <a href="{{ $verificationUrl }}">Verify Email</a>
    <p>If you did not create an account, no further action is required.</p>


@endsection
