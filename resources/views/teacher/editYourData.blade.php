@extends('teacher.index')

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
        <form action="{{route('teacher.updateYourData',[Auth::user()->id])}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                <div class="form-row" >
                        <div class="form-group col-md-6">
                          <label for="name">Name </label>
                        <input type="text" class="form-control" id="name" placeholder="Name" name="name"   value="{{Auth::user()->name}}">
                        <span class="text-danger">{{$errors->first('name')}}</span>
                    </div>

                        <div class="form-group col-md-6">
                                <label for="job">Job  </label>
                        <input type="text" class="form-control" id="job" placeholder="Job" name="job"   value="{{$teacher->job}}">
                        <span class="text-danger">{{$errors->first('job')}}</span>
                    </div>

                        <div class="form-group col-md-6">
                                <label for="teacherNumber">Teacher Number : </label>
                        <input type="text" class="form-control" id="teacherNumber" name="teacherNumber"   value="{{$teacher->teacherNumber}}" readonly>
                    </div>

                        <div class="form-group col-md-6">
                                <label for="division">Divison  </label>
                        <input type="text" class="form-control" id="division" placeholder="Division" name="division"   value="{{$teacher->division}}">
                        <span class="text-danger">{{$errors->first('division')}}</span>
                    </div>

                        <div class="form-group col-md-6">
                                <label for="phone">Phone Number  </label>
                        <input type="text" class="form-control" id="phone" placeholder="Phone Number" name="phone"   value="{{$teacher->phone}}">
                        <span class="text-danger">{{$errors->first('phone')}}</span>
                    </div>

                        <div class="form-group col-md-6">
                                <label for="email">Email </label>
                        <input type="email" class="form-control" id="email" name="email"   value="{{Auth::user()->email}}"  readonly>
                            </div>

                        <div class="form-group col-md-6">
                                <label for="college">College </label>
                        <input type="text" class="form-control" id="college" placeholder="College" name="college"   value="{{$teacher->college}}">
                        <span class="text-danger">{{$errors->first('college')}}</span>
                    </div>

                        <div class="form-group col-md-6">
                                <label for="gender">Gender </label>
                                <select class="form-control" name="gender">
                                        <option value="male"{{$teacher->gender =='male' ? 'selected':''}}> Male</option>
                                        <option value="femal"{{$teacher->gender =='femal' ? 'selected':''}}> Femal</option>
                                </select>
                            </div>

                            <div class="form-group col-md-6">
                                    <label for="password">Password </label>
                                    <input type="password" class="form-control" id="password" placeholder="Password" name="password"   value="{{Auth::user()->password}}">
                                    <span class="text-danger">{{$errors->first('password')}}</span>
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="cv">Cv </label>
                                    <input type="file" class="form-control" id="cv"  name="cv" />
                                    <span class="text-danger">{{$errors->first('cv')}}</span>
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
