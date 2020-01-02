@extends('admin.index')

@section('content')

<br/>
<br/>
<br/>
<div class="row">

        <div class="col-md-12">

            @if(session()->has('success'))
                <div class="alert alert-success">

                    {{session()->get('success')}}

                </div>

                @endif

            </div>
 </div>


<div class="panel panel-info">
        <div class="panel-heading "><p style="text-align: center ; font-size: 1.5em">Add Student</p></div>
        <div class="panel-body">
        <form action="{{route('admin.addStudent')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                        <div class="form-row">
                          <div class="form-group col-md-6">
                            <label for="studentnumber">Student Number</label>
                            <input type="text" class="form-control" id="studentnumber" placeholder="Student Number" name="studentNumber"   value="{{ old('studentNumber') }}">
                            <span class="text-danger">{{$errors->first('studentNumber')}}</span>
                        </div>
                          <div class="form-group col-md-6">
                                <label for="studentnumber">Name </label>
                                <input type="text" class="form-control" id="name" placeholder="Name" name="name"  value="{{ old('name') }}">
                                <span class="text-danger">{{$errors->first('name')}}</span>
                            </div>
                            <div class="form-group col-md-6">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control" id="email" placeholder=" Email" name="email"  value="{{ old('email') }}">
                                    <span class="text-danger">{{$errors->first('email')}}</span>
                                </div>
                          <div class="form-group col-md-6">
                            <label for="inputPassword4">Password</label>
                            <input type="password" class="form-control" id="inputPassword4" placeholder="Password" name="password" value="{{ old('email') }}">
                            <span class="text-danger">{{$errors->first('password')}}</span>
                        </div>
                          <div class="form-group col-md-6">
                                <label for="college">College</label>
                                <input type="text" class="form-control" id="college" placeholder="College" name="college" value="{{ old('college') }}">
                                <span class="text-danger">{{$errors->first('college')}}</span>
                            </div>
                            <div class="form-group col-md-6">
                                    <label for="division">Division</label>
                                    <input type="text" class="form-control" id="division" placeholder="Division" name="division" value="{{ old('division') }}">
                                    <span class="text-danger">{{$errors->first('division')}}</span>
                                </div>
                            <div class="form-group col-md-6">
                                    <label for="gender">Gender</label>
                                    <select class="form-control" name="gender">
                                        <option value="male"> Male</option>
                                        <option value="femal"> Femal</option>

                                    </select>
                            </div>
                            <div class="form-group col-md-6">
                                    <label for="level">Level</label>
                                    <select class="form-control" name="level">
                                            <option value="1"> 1</option>
                                            <option value="2"> 2</option>
                                            <option value="3"> 3</option>
                                            <option value="4"> 4</option>
                                            <option value="5"> 5</option>

                                        </select>
                            </div>
                        </div>




                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                <button type="submit" class="btn btn-primary"> Add</button>
                                <button type="reset" class="btn btn-danger"> Reset</button>

                            </div>
                    </form>
        </div>
      </div>


@endsection
