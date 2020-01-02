@extends('student.index')

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
        <div class="panel-heading "><p style="text-align: center ; font-size: 1.5em"> Your Data   </p></div>
        <div class="panel-body">
        <form action="{{route('student.updateYourData',[Auth::user()->id])}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                <div class="form-row" >
                        <div class="form-group col-md-6">
                          <label for="name">Name </label>
                        <input type="text" class="form-control" id="name" placeholder="Name" name="name"   value="{{Auth::user()->name}}">
                        <span class="text-danger">{{$errors->first('name')}}</span>
                    </div>

                        <div class="form-group col-md-6">
                                <label for="studentNumber">Student Number : </label>
                        <input type="text" class="form-control" id="studentNumber" name="studentNumber"   value="{{$student->studentNumber}}" readonly>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="gender">Gender </label>
                        <select class="form-control" name="gender">
                                <option value="male"{{$student->gender =='male' ? 'selected':''}}> Male</option>
                                <option value="femal"{{$student->gender =='femal' ? 'selected':''}}> Femal</option>
                        </select>
                    </div>


                        <div class="form-group col-md-6">
                            <label for="college">College </label>
                            <input type="text" class="form-control" id="college" placeholder="College" name="college"   value="{{$student->college}}">
                            <span class="text-danger">{{$errors->first('college')}}</span>
                        </div>

                        <div class="form-group col-md-6">
                                <label for="division">Divison  </label>
                        <input type="text" class="form-control" id="division" placeholder="Division" name="division"   value="{{$student->division}}">
                        <span class="text-danger">{{$errors->first('division')}}</span>
                        </div>

                             <div class="form-group col-md-6">
                                <label for="level">Level </label>
                        <input type="text" class="form-control" id="level" placeholder="Level" name="level"   value="{{$student->level}}">
                        <span class="text-danger">{{$errors->first('level')}}</span>
                        </div>


                        <div class="form-group col-md-6">
                                <label for="email">Email </label>
                        <input type="email" class="form-control" id="email" name="email"   value="{{Auth::user()->email}}"  readonly>
                            </div>


                            <div class="form-group col-md-6">
                                    <label for="password">Password </label>
                                    <input type="password" class="form-control" id="password" placeholder="Password" name="password"   value="{{Auth::user()->password}}">
                                    <span class="text-danger">{{$errors->first('password')}}</span>
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
