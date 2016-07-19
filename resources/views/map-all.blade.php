@extends('layouts.index')

@section('title', 'Автосервисы в Одинцово на карте')
@section('description', '')

@section('content')
	<style type="text/css">
		html, body, main, section {
			width: 100%;
			height: 100%;
		}

		body {
			/*padding: 10px;*/
		}

		section {
			
		}

		h1 {
			font-size: 16px;
		    text-transform: uppercase;
		    color: #615c5c;
		}

        #map-all {
            /*width: 700px;*/
            /*height: 450px;*/
            width: 100%;
            /*height: 700px;*/
            height: 100%;
            margin: 0;
            padding: 0;
        }

        header {
        	height: auto;
        }
    </style>

	<section>
		<h1>{{ $catalog->count() }} Автосервиса в Одинцово</h1>

		@include('partials.map-all', compact('catalog'))
	</section>
@stop
