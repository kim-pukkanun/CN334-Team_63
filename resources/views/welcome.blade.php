@extends('layouts.app')

@section('content')
<div class="container">
    <div class="bg-image ripple rounded-9 mt-2" data-mdb-ripple-color="light">
        <img src="https://images.pexels.com/photos/461077/pexels-photo-461077.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=750&w=1260" class="w-100"/>
        <a>
            <div class="mask" style="background-color: rgba(0, 0, 0, 0.4)">
                <div class="d-flex justify-content-center align-items-center h-50">
                    <div class="row justify-content-center">
                        <div class="col-md-10">
                            <div class="card">
                                <div class="card-header text-center">
                                    Welcome to Tasker
                                </div>
                                <div class="card-body">
                                    <p class="card-text text-center">
                                        Go finish your work and be done with it.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="hover-overlay">
                <div class="mask" style="background-color: rgba(251, 251, 251, 0.2)"></div>
            </div>
        </a>
    </div>
</div>
@endsection
