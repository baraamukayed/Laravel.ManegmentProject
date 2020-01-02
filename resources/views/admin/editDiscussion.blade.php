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
        <div class="panel-heading "><p style="text-align: center ; font-size: 1.5em">Edit Discussion  </p></div>
        <div class="panel-body">

        <form action="{{route('admin.updateDiscussion',[$discussion->id])}}" method="POST">
            @method('PUT')
            @csrf
                        <div class="form-row">
                          <div class="form-group col-md-6">
                            <label for="projecttitle">Project Title : </label>
                            <select id="project" style="width: 200px" name="project_id">
                                    <option value="">Select Project</option>
                                    @foreach ($projects as $project)
                                     <option value="{{$project->id}}" {{$discussion->project_id==$project->id ? 'selected' : ''}}>{{$project->title}}</option>
                                    @endforeach
                            </select>
                            <span class="text-danger">{{$errors->first('project_id')}}</span>
                        </div>

                          <div class="form-group col-md-6">
                                <label for="teacher"> Teacher</label>
                                <select id="teacher" style="width: 200px" name="teacher_id">
                                        <option value="">Select Teacher : </option>
                                        @foreach ($teachers as $teacher)
                                         <option value="{{$teacher->id}}"{{$discussion->teacher_id==$teacher->id ? 'selected' : ''}}>{{$teacher->user->name}}</option>
                                        @endforeach
                                </select>
                                <span class="text-danger">{{$errors->first('teacher_id')}}</span>
                            </div>

                              <div>

                                <div class="form-group col-md-6">
                                        <label for="date"> Date</label>
                                <input type="date" class="form-control" name="date" value="{{$discussion->date}}"/>
                                <span class="text-danger">{{$errors->first('date')}}</span>
                                </div>

                                <div class="form-group col-md-6">
                                        <label for="time"> Time</label>
                                <input type="time" class="form-control" name="time" value="{{$discussion->time}}"/>
                                        <span class="text-danger">{{$errors->first('time')}}</span>
                                </div>

                              </div>

                                <div class="form-group col-md-12">
                                        <label for="place"> Place</label>
                                <input type="text" class="form-control" id="place" placeholder=" Place" name="place" value="{{$discussion->place}}"/>
                                        <span class="text-danger">{{$errors->first('place')}}</span>
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

@section('scripts')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="{{asset('assets/js/select2.min.js')}}"></script>

<script>
        $("#project").select2( {
            placeholder: "Select Project",
            allowClear: true
            } );

            $("#teacher").select2( {
            placeholder: "Select Teacher",
            allowClear: true
            } );
        </script>
@endsection
