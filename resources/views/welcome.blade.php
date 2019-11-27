<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Edisoft - Helpdesk</title>

        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    </head>
    <body>
    	<div class="container">
		<header class="blog-header py-3">
		    <div class="row flex-nowrap justify-content-between align-items-center">
		      <div class="col-4 pt-1"></div>
		      <div class="col-4 text-center">
		        <a class="blog-header-logo text-dark" href="{{ route('home') }}"><h3>Help Desk</h3></a>
		      </div>
		      <div class="col-4 d-flex justify-content-end align-items-center">
		        <a href="{{ route('admin') }}">Вход в панель администратора</a>
		      </div>
		    </div>
		    <hr />
		</header>

		@if(Session::has('messages'))
            <div class="alert alert-success" role="alert">
				{{Session::get('messages')}}
				{{Session::forget('messages')}}
			</div>
        @endif
		
		@section('content')
        @show
		
		</div>
		<hr />
		<footer class="blog-footer">
		  <center><p>2019 г.</p></center>
		</footer>	
    </body>
</html>
