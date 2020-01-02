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
        <div class="panel-heading "><p style="text-align: center ; font-size: 1.5em">Add Teacher</p></div>
        <div class="panel-body">
                <form action="{{route('admin.addTeacher')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                        <div class="form-row">
                          <div class="form-group col-md-6">
                            <label for="teachernumber">Teacher Number</label>
                            <input type="text" class="form-control" id="teachernumber" placeholder="Teacher Number" name="teacherNumber" value="{{ old('teacherNumber') }}" >
                            <span class="text-danger">{{$errors->first('teacherNumber')}}</span>
                        </div>
                          <div class="form-group col-md-6">
                                <label for="studentnumber">Name </label>
                                <input type="text" class="form-control" id="name" placeholder="Name" name="name" value="{{ old('name') }}">
                                <span class="text-danger">{{$errors->first('name')}}</span>

                            </div>
                            <div class="form-group col-md-6">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control" id="email" placeholder=" Email" name="email" value="{{ old('email') }}">
                                    <span class="text-danger">{{$errors->first('email')}}</span>

                                </div>
                          <div class="form-group col-md-6">
                            <label for="inputPassword4">Password</label>
                            <input type="password" class="form-control" id="inputPassword4" placeholder="Password" name="password" value="{{ old('password') }}">
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
                                    <label for="sex">Gender</label>
                                    <select class="form-control" name="gender">
                                        <option value="male"> Male</option>
                                        <option value="femal"> Femal</option>
                                    </select>
                                </div>
                            <div class="form-group col-md-6">
                                    <label for="phone">Phone Number</label>
                                    <input type="text" class="form-control" id="phone" placeholder="Phone Number" name="phone" value="{{ old('phone') }}">
                                    <span class="text-danger">{{$errors->first('phone')}}</span>

                                </div>

                            <div class="form-group col-md-6">
                                    <label for="job">Job</label>
                                    <input type="text" class="form-control" id="job" placeholder="Job" name="job" value="{{ old('job') }}">
                                    <span class="text-danger">{{$errors->first('job')}}</span>
                            </div>

                            <div class="form-group col-md-6">
                                    <label for="cv"> Cv</label>
                                    <input type="file" class="form-control" name="cv"/>
                                    <span class="text-danger">{{$errors->first('cv')}}</span>
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
