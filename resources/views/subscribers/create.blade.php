@extends('layout')

@section('content')
    <h1>Create a new subscriber</h1>

    <div class="card mb-4">

        <div class="card-body">

            <form action="{{ route('subscribers.store') }}" method="POST">

                @csrf

                <div class="form-group">
                    <label>Name:</label>
                    <input name='name' type="text" class="form-control" value="{{old('name')}}">
                </div>

                <div class="form-group">
                    <label>email:</label>
                    <input name='email' type="email" class="form-control" value="{{old('email')}}">
                </div>

                <div class="form-group">
                    <label>Address:</label>
                    <input name='address'type="text" class="form-control" value="{{old('address')}}">
                </div>

                <div class="form-group">
                    <label>Status</label>
                    <select name='status' class="form-control">
                        <option value="active">Active</option>
                        <option value="bounced">Bounced</option>
                        <option value="junk">Junk</option>
                        <option value="unconfirmed">Unconfirmed</option>
                        <option value="unsubscribed">Unsubscribed</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-primary">Create Subscriber</button>

            </form>

        </div>



@stop
