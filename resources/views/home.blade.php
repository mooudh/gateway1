@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!
                </div>
                <div class="card-body">

                  <form class="" action="/home" method="post">
                    {{ csrf_field() }}
                    <select class="" name="bank">
                      <option value="mellat">mellat</option>
                      <option value="maskan">maskan</option>
                      <option value="asanpardakht">asanpardakht</option>
                      <option value="zarinpal">zarinpal</option>
                      <option value="saman">saman</option>
                      <option value="sadad">sadad</option>
                      <option value="parsian">parsian</option>

                    </select>
                    <br><br>
                    <label>username:</label>
                    <input type="text" name="username" value="">
                    <br><br>
                    <label>password:</label>

                    <input type="text" name="password" value="">
                    <br><br>
                    <label>terminalId:</label>

                    <input type="text" name="terminalId" value="">
                    <br><br>
                    <label>callback-url:</label>

                    <input type="text" name="callback_url" value="">
                    <br><br>


                    <input id="submit" type="submit" name="submit" value="submit">
                  </form>



              </div>

            </div>
        </div>
    </div>
</div>
@endsection
