
@extends('layouts.default')
@section('content')
	<body class="custom-body">
		<div class="custom-header-container">
			<header class="custom-wrapper">
				<h1>Open Food Facts</h1>
				<nav>
					<ul>
						<li><form id="search" name="search" action='/dispatch' method="POST">
							{{ csrf_field() }}
							<label for="productName">Search By Name:</label>
							<input type="text" id="productName" name="productName" 
								value='{{ $foodFacts["currentProductName"] }}'>
							<input type="submit" name="actionDispatched" value="Search">
						</li>
						<li>
						<a class="button-link" href='/openFoodFacts/{{ $foodFacts["prevPage"] }}'><</a>
						<form id="page" name="page" action='/dispatch' method="POST">
							{{ csrf_field() }}
							<input type="text" class="paginator" id="pageNo" name="pageNo" width="10px" value='{{ $foodFacts["currentPage"] }}'>
							<span>of {{ $foodFacts["lastPage"] }}</span>
							<input type="submit" name="actionDispatched" value="Jump To">
						</form>
						<a class="button-link" href='/openFoodFacts/{{ $foodFacts["nextPage"] }}'>></a>
						</li>
					</ul>
				</nav>
			</header>
		</div>
		<div class="main-container">
			@if (array_key_exists("Message", $foodFacts))
				<div class="message-container">
					<div>{{ $foodFacts["Message"] }}<br></div>
				</div>
			@endif
			@if ((array_key_exists("products", $foodFacts) && count($foodFacts["products"]) >= 1))
				@foreach($foodFacts["products"] as $item)
					<div class="main-data-block">
						<div>ID: {{ $item["ID"] }}</div>
						<div class="image-container">
							Image:<br/>
							<a href='{{ $item["Image"] }}' target='blank_'>
								<img src='{{ $item["Image"] }}'/>
							</a>
						</div>
						<div>Name: {{ $item["Name"] }}</div>
						<div>Category: {{ $item["Category"] }}</div>
						<div class="storage-container">
							<form action="/store" method="POST">
								{{ csrf_field() }}
								<input type="hidden" name="ID" id="ID" value='{{ $item["ID"] }}'>
								<input type="hidden" name="Image" id="Image" value='{{ $item["Image"] }}'>
								<input type="hidden" name="Name" id="Name" value='{{ $item["Name"] }}'>
								<input type="hidden" name="Category" id="Category"
									value='{{ $item["Category"] }}'>
								<input type="hidden" name="pageNo" id="pageNo" 
									value='{{ $foodFacts["currentPage"] }}'>
								<input type="hidden" name="productName" id="productName" 
									value='{{ $foodFacts["currentProductName"] }}'>
								<input type="submit" name="storeItem" value="Store Item">
							</form>
						</div>
					</div>
				@endforeach
			@else
				<div class="message-container">
                                        <div>No food facts found or error occured.<br></div>
                                </div>
			@endif
		</div>
	</body>
@endsection
