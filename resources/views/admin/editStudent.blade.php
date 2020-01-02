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
        <div class="panel-heading "><p style="text-align: center ; font-size: 1.5em">Edit Student</p></div>
        <div class="panel-body">
        <form action="{{route('admin.updateStudent',[$student->id])}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                        <div class="form-row">
                          <div class="form-group col-md-6">
                            <label for="studentnumber">Student Number</label>
                          <input type="text" class="form-control" id="studentnumber" placeholder="Student Number" name="studentNumber"   value="{{$student->studentNumber}}">
                            <span class="text-danger">{{$errors->first('studentNumber')}}</span>
                        </div>
                          <div class="form-group col-md-6">
                                <label for="studentnumber">Name </label>
                          <input type="text" class="form-control" id="name" placeholder="Name" name="name"  value="{{$user->name}}">
                                <span class="text-danger">{{$errors->first('name')}}</span>
                            </div>
                            <div class="form-group col-md-6">
                                    <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" placeholder=" Email" name="email"  value="{{$user->email}}">
                                    <span class="text-danger">{{$errors->first('email')}}</span>
                                </div>
                          <div class="form-group col-md-6">
                            <label for="inputPassword4">Password</label>
                          <input type="password" class="form-control" id="inputPassword4" placeholder="Password" name="password" value="{{$user->password}}">
                            <span class="text-danger">{{$errors->first('password')}}</span>
                        </div>
                          <div class="form-group col-md-6">
                                <label for="college">College</label>
                          <input type="text" class="form-control" id="college" placeholder="College" name="college" value="{{$student->college}}">
                                <span class="text-danger">{{$errors->first('college')}}</span>
                            </div>
                            <div class="form-group col-md-6">
                                    <label for="division">Division</label>
                            <input type="text" class="form-control" id="division" placeholder="Division" name="division" value="{{$student->division}}">
                                    <span class="text-danger">{{$errors->first('division')}}</span>
                                </div>
                            <div class="form-group col-md-6">
                                    <label for="gender">Gender</label>
                                    <select class="form-control" name="gender">
                                        <option value="male" {{$student->gender == 'male' ? 'selected':''}}> Male</option>
                                        <option value="femal" {{$student->gender == 'femal' ? 'selected':''}}> Femal</option>

                                    </select>
                            </div>
                            <div class="form-group col-md-6">
                                    <label for="level">Level</label>
                                    <select class="form-control" name="level">
                                            <option value="1" {{$student->level == '1' ? 'selected':''}}> 1</option>
                                            <option value="2" {{$student->level == '2' ? 'selected':''}}> 2</option>
                                            <option value="3" {{$student->level == '3' ? 'selected':''}}> 3</option>
                                            <option value="4" {{$student->level == '4' ? 'selected':''}}> 4</option>
                                            <option value="5" {{$student->level == '5' ? 'selected':''}}> 5</option>
                                        </select>
                            </div>
                        </div>




                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                <button type="submit" class="btn btn-primary"> Edit</button>
                                <button type="reset" class="btn btn-danger"> Reset</button>

                            </div>
                    </form>
        </div>
      </div>


@endsection
