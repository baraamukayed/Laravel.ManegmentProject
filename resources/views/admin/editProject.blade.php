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
        <div class="panel-heading "><p style="text-align: center ; font-size: 1.5em"> Edit Project</p></div>
        <div class="panel-body">

        <form action="{{route('admin.updateProject',[$project->id])}}" method="POST" enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                        <div class="form-row">
                          <div class="form-group col-md-12">
                            <label for="projecttitle">Project Title</label>
                          <input type="text" class="form-control" id="projecttitle" placeholder="Project Title" name="title" value="{{$project->title}}">
                            <span class="text-danger">{{$errors->first('title')}}</span>
                        </div>

                          <div class="form-group col-md-12">
                                <label for="projectclassification">Project Type</label>
                          <input type="text" class="form-control" id="projecttype" placeholder="Project Type" name="type" value="{{$project->type}}">
                                <span class="text-danger">{{$errors->first('type')}}</span>
                            </div>

                              <div class="form-group col-md-12">
                                    <label for="Description">Project Description</label>
                                    <textarea class="form-control" id="Description" name="description" value="{{$project->description}}">
                                    </textarea>
                                    <span class="text-danger">{{$errors->first('description')}}</span>
                                </div>

                            <div class="form-group col-md-12">
                                    <label for="explanatory"> Send an explanatory file</label>
                                    <input type="file" class="form-control" name="explanatory"/>
                                    <span class="text-danger">{{$errors->first('explanatory')}}</span>
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
