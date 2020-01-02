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
        <div class="panel-heading "><p style="text-align: center ; font-size: 1.5em">Add Student To Your Group   </p></div>
        <div class="panel-body">

           <form  action="{{route('student.addGroup')}}" method="POST">
            @csrf
                        <div class="form-row">

                            <div class="form-group col-md-12">
                                    <label for="name">Student Name :</label>
                                    <select id="student" style="width: 200px" name="student_id">
                                            <option value="">Select Student</option>
                                    @foreach ($students as $student)
                                    <option value="{{$student->id}}">{{$student->user->name}}</option>
                                    @endforeach
                                </select>
                            </div>


                        </div>

                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-0">
                                <button type="submit" class="btn btn-primary"> Add</button>
                                <button type="reset" class="btn btn-danger"> Reset</button>

                            </div>

    </form>


        </div>
      </div>


@endsection


@section('scripts')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="{{asset('assets/js/select2.min.js')}}"></script>

<script>
        $("#student").select2( {
            placeholder: "Select Student",
            allowClear: true
            } );


        </script>
@endsection
