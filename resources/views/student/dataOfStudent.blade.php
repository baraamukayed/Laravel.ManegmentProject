@extends('student.index')

@section('content')

<br/>
<br/>
<br/>


<div class="panel panel-info">
        <div class="panel-heading "><p style="text-align: center ; font-size: 1.5em">Data Of Student   </p></div>
        <div class="panel-body">

                <div class="form-row" >
                        <div class="form-group col-md-6">
                          <label for="name">Name : </label>
                        <span>{{Auth::user()->name}}</span>
                        </div>

                        <div class="form-group col-md-6">
                                <label for="studenNumber">Student Number : </label>
                                <span>{{$student->studentNumber}}</span>
                        </div>

                        <div class="form-group col-md-6">
                                <label for="gender">gender :  </label>
                                <span>{{$student->gender}}  </span>
                        </div>

                        <div class="form-group col-md-6">
                                <label for="college">College  :  </label>
                                <span>{{$student->college}}  </span>
                        </div>

                        <div class="form-group col-md-6">
                                <label for="division">Division  :  </label>
                                <span>{{$student->division}}  </span>
                        </div>

                        <div class="form-group col-md-6">
                                <label for="level">Level  :  </label>
                                <span>{{$student->level}}  </span>
                        </div>

                        <div class="form-group col-md-6">
                                <label for="email">Email : </label>
                        <span>{{Auth::user()->email}}</span>
                        </div>

                        <div class="form-group col-md-12">
                                <svg height="5px" width="100%">
                                        <line x1="0" y1="0" x2="100%" y2="0" style="stroke:rgb(176,224,230);stroke-width:2" />
                                      </svg>
                        </div>

                        <div class="form-group col-md-12">
                                <label for="edit">  <i class="fa fa-arrow-right"></i> You can to Edit your data   </label>

                                  <form action="{{route('student.editYourData',[Auth::user()->id])}}" >
                                       @csrf
                                       <button type="submit" class="btn btn-primary">Edit</button>
                                   </form>
                        </div>

                </div>


        </div>
      </div>


@endsection
