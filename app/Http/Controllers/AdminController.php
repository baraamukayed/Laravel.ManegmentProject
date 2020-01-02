<?php

namespace App\Http\Controllers;

use App\Discussion;
use App\Project;
use App\Student;
use App\Teacher;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Webpatser\Uuid\Uuid;


class AdminController extends Controller
{


    public function index(){
        if(Auth::user()->role == 'admin'){

        return view('admin.main');
        }
        return redirect()->back();
    }

    /////////////////////////////////////// Teacher     ///////////////////////////////////////


    public function ShowAddTeacher(){
        if(Auth::user()->role == 'admin'){

            return view('admin.addTeacher');

        }
        return redirect()->back();
    }

        ///////////////////////////////////////

    public function addTeacher(Request $request){
        if(Auth::user()->role == 'admin'){

            $request->validate([
                'teacherNumber' => 'required|digits:6',
                'name' => 'required|string',
                'email' => 'required|unique:users,email',
                'password' => 'required',
                'college' => 'required|string',
                'division' => 'required|string',
                'phone' => 'required',
                'job' => 'required|string',
                'cv' => 'required|file',

            ]
                ,[

                    'teacherNumber.required' => 'Teacher Number is required',
                    'teacherNumber.digits' => 'Teacher Number must be 6 Numbers',
                    'name.required' => 'Name is required',
                    'name.string' => 'Name must be String',
                    'email.required' => 'Email is required',
                    'email.unique' => 'Email is unavailable (Write another Email)',
                    'password.required' => 'Password is required',
                    'college.required' => 'College is required',
                    'college.string' => 'College must be String',
                    'division.required' => 'Division is required',
                    'division.string' => 'Division must be String',
                    'phone.required' => 'Phone is required',
                    'job.required' => 'Job is required',
                    'job.string' => 'Job must be String',
                    'cv.required' => 'Cv is required',
                    'cv.file' => 'Cv must be File',



                ]
        );

            $user = new User();
            $user->name = $request->input('name');
            $user->email = $request->input('email');
            $user->password =Hash :: make( $request->input('password'));
            $user->role = 'teacher';
            $user->save();

            $teacher = new Teacher();
            $teacher->teacherNumber = $request->input('teacherNumber');
            $teacher->college = $request->input('college');
            $teacher->division = $request->input('division');
            $teacher->gender = $request->input('gender');
            $teacher->phone = $request->input('phone');
            $teacher->job = $request->input('job');

            $teacher['uuid'] = (string)Uuid::generate();
            if ($request->hasFile('cv')) {
                $teacher['cv'] = $request->cv->getClientOriginalName();
                $request->cv->storeAs('cvv', $teacher['cv']);
            }

            $teacher->user_id = $user->id;
            $teacher->save();

            return redirect()->back()->with('success','Teacher is Adding Now');

        }
        return redirect()->back();

    }

///////////////////////////////////////


    public function download($uuid)
    {
        $teacher = Teacher::where('uuid', $uuid)->firstOrFail();
        $pathToFile = storage_path('app/cvv/' . $teacher->cv);
        return response()->download($pathToFile);
    }

    public function downloadexplanatory($uuid)
    {
        $project = Project::where('uuid', $uuid)->firstOrFail();
        $pathToFile = storage_path('app/explanatories/' . $project->explanatory);
        return response()->download($pathToFile);
    }

    ///////////////////////////////////////

    public function showTeachers(){
        if(Auth::user()->role == 'admin'){

            $users = User::where('role','=','teacher');
            $users =  $users->paginate(5);

            $discussion = Discussion::all();
            $project = Project::all();

        return view('admin.teachers',compact(['users','discussion','project']));
        }
        return redirect()->back();

    }

    ///////////////////////////////////////


    public function deleteTeacher($id){
        if(Auth::user()->role == 'admin'){

        $teacher = Teacher::findOrFail($id);
        $userTeacher = $teacher->user_id;
        $user = User::findOrFail($userTeacher);
        $name = $user->name;
        $teacher->delete();
        $user->delete();
        return redirect()->back()->with('success',"Teacher ($name) is Deleted");
        }
        else{
            return redirect()->back();

        }

    }
        ///////////////////////////////////////


    public function editTeacher($id){
        if(Auth::user()->role == 'admin'){

        $teacher = Teacher::findOrFail($id);
        $userTeacher = $teacher->user_id;
        $user = User::findOrFail($userTeacher);

        return view('admin.editTeacher',compact(['teacher','user']));
        }
        else{
            return redirect()->back();

        }
    }

    ///////////////////////////////////////

    public function updateTeacher(Request $request , $id){

        if(Auth::user()->role == 'admin'){

            $request->validate([
                'teacherNumber' => 'required|digits:6',
                'name' => 'required|string',
                'email' => 'required|unique:users,email',
                'password' => 'required',
                'college' => 'required|string',
                'division' => 'required|string',
                'phone' => 'required',
                'job' => 'required|string',
                'cv' => 'required|file',

            ]
                ,[

                    'teacherNumber.required' => 'Teacher Number is required',
                    'teacherNumber.digits' => 'Teacher Number must be 6 Numbers',
                    'name.required' => 'Name is required',
                    'name.string' => 'Name must be String',
                    'email.required' => 'Email is required',
                    'email.unique' => 'Email is unavailable (Write another Email)',
                    'password.required' => 'Password is required',
                    'college.required' => 'College is required',
                    'college.string' => 'College must be String',
                    'division.required' => 'Division is required',
                    'division.string' => 'Division must be String',
                    'phone.required' => 'Phone is required',
                    'job.required' => 'Job is required',
                    'job.string' => 'Job must be String',
                    'cv.required' => 'Cv is required',
                    'cv.file' => 'Cv must be File',

                ]
        );

        $teacher = Teacher::findOrFail($id);
        $userTeacher = $teacher->user_id;
        $user = User::findOrFail($userTeacher);
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password =Hash :: make( $request->input('password'));
        $user->role = 'teacher';
        $user->update();

        $teacher->teacherNumber = $request->input('teacherNumber');
        $teacher->college = $request->input('college');
        $teacher->division = $request->input('division');
        $teacher->gender = $request->input('gender');
        $teacher->phone = $request->input('phone');
        $teacher->job = $request->input('job');

        $teacher['uuid'] = (string)Uuid::generate();
        if ($request->hasFile('cv')) {
            $teacher['cv'] = $request->cv->getClientOriginalName();
            $request->cv->storeAs('cvv', $teacher['cv']);
        }
        $teacher->user_id = $user->id;

        $teacher->update();

        return redirect()->back()->with('success','Teacher is Updating Now');

        }
        else{
            return redirect()->back();

        }

    }
        /////////////////////////////////////// Student     ///////////////////////////////////////


    public function showStudents(){
        if(Auth::user()->role == 'admin'){
            $users = User::where('role','=','student');
            $users =  $users->paginate(5);
        return view('admin.students',compact('users'));
             }
             else{
                return redirect()->back();
            }
    }

    ///////////////////////////////////////

    public function showAddStudent(){
        if(Auth::user()->role == 'admin'){
            return view('admin.addStd');
        }
        else{
           return redirect()->back();
       }
    }

    ///////////////////////////////////////


    public function addStudent(Request $request){
        if(Auth::user()->role == 'admin'){

            $request->validate([
                'studentNumber' => 'required|digits:6',
                'name' => 'required|string',
                'email' => 'required|unique:users,email',
                'password' => 'required',
                'college' => 'required|string',
                'division' => 'required|string',
            ]
                ,[

                    'studentNumber.required' => 'Student Number is required',
                    'studentNumber.digits' => 'Student Number must be 6 Numbers',
                    'name.required' => 'Name is required',
                    'name.string' => 'Name must be String',
                    'email.required' => 'Email is required',
                    'email.unique' => 'Email is unavailable (Write another Email)',
                    'password.required' => 'Password is required',
                    'college.required' => 'College is required',
                    'college.string' => 'College must be String',
                    'division.required' => 'Division is required',
                    'division.string' => 'Division must be String',

                ]
        );

            $user = new User();
            $user->name = $request->input('name');
            $user->email = $request->input('email');
            $user->password =Hash::make($request->input('password'));
            $user->role = 'student';
            $user->save();

            $student = new Student();
            $student->user_id = $user->id;
            $student->studentNumber = $request->input('studentNumber');
            $student->college = $request->input('college');
            $student->division = $request->input('division');
            $student->gender = $request->input('gender');
            $student->level = $request->input('level');
            $student->save();

            return redirect()->back()->with('success','Student is Adding Now');

        }
        else{
            return redirect()->back();
        }
    }

    ///////////////////////////////////////

    public function deleteStudent($id){
        if(Auth::user()->role == 'admin'){

            $student = Student::findOrFail($id);
            $userStudent = $student->user_id;
            $user = User::findOrFail($userStudent);
            $name = $user->name;
            $student->delete();
            $user->delete();
            return redirect()->back()->with('success',"Student ($name) is Deleted");
            }
            else{
                return redirect()->back();
        }

    }

    ///////////////////////////////////////

    public function editStudent($id){
        if(Auth::user()->role == 'admin'){

        $student = Student::findOrFail($id);
        $userStudent = $student->user_id;
        $user = User::findOrFail($userStudent);

        return view('admin.editStudent',compact(['student','user']));
        }
        else{
            return redirect()->back();

        }
    }

        ///////////////////////////////////////

    public function updateStudent(Request $request , $id){

        if(Auth::user()->role == 'admin'){

            $request->validate([
                'studentNumber' => 'required|digits:6',
                'name' => 'required|string',
                'email' => 'required|unique:users,email',
                'password' => 'required',
                'college' => 'required|string',
                'division' => 'required|string',
            ]
                ,[

                    'studentNumber.required' => 'Teacher Number is required',
                    'studentNumber.digits' => 'Teacher Number must be 6 Numbers',
                    'name.required' => 'Name is required',
                    'name.string' => 'Name must be String',
                    'email.required' => 'Email is required',
                    'email.unique' => 'Email is unavailable (Write another Email)',
                    'password.required' => 'Password is required',
                    'college.required' => 'College is required',
                    'college.string' => 'College must be String',
                    'division.required' => 'Division is required',
                    'division.string' => 'Division must be String',

                ]
        );

        $student = Student::findOrFail($id);
        $userStudent = $student->user_id;
        $user = User::findOrFail($userStudent);
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password =Hash :: make( $request->input('password'));
        $user->role = 'student';
        $user->update();

        $student->studentNumber = $request->input('studentNumber');
        $student->college = $request->input('college');
        $student->division = $request->input('division');
        $student->gender = $request->input('gender');
        $student->level = $request->input('level');
        $student->user_id = $user->id;

        $student->update();

        return redirect()->back()->with('success','Student is Updating Now');

        }
        else{
            return redirect()->back();

        }

    }

    ///////////////////////////////////////   Projects  ///////////////////////////////////////


        public function showAddNewProject(){

            return view('admin.addProject');
        }

        ///////////////////////////////////////

        public function addProject(Request $request){
            if(Auth::user()->role == 'admin'){


            $request->validate([
                'title' => 'required|string',
                'type' => 'required|string',
                'description' => 'required|string',
                'explanatory' => 'required|file',

            ]
                ,[

                    'title.required' => 'Title is required',
                    'title.string' => 'Title must be String',
                    'type.required' => 'Type is required',
                    'type.string' => 'Type must be String',
                    'description.required' => 'Description is required',
                    'description.string' => 'Description must be String',
                    'explanatory.required' => 'Explanatory is required',
                    'explanatory.file' => 'Explanatory must be File',

                ]
        );

            $project = new Project();
            $project->title = $request->input('title');
            $project->type = $request->input('type');
            $project->description = $request->input('description');

            $project['uuid'] = (string)Uuid::generate();
            if ($request->hasFile('explanatory')) {
                $project['explanatory'] = $request->explanatory->getClientOriginalName();
                $request->explanatory->storeAs('explanatories', $project['explanatory']);
            }

            $project->user_id = Auth::user()->id;
            $project->save();

            return redirect()->back()->with('success','Project is Adding Now');
            }
            else{
                return redirect()->back();
            }
        }

        ///////////////////////////////////////

        public function showSuggestedProject(){
            if(Auth::user()->role == 'admin'){

            $projects = Project::all()->first();
            $projects = $projects->paginate(5);

            return view('admin.suggestedProject',compact('projects'));
            }
            else{
                return redirect()->back();
            }
        }

        ///////////////////////////////////////

        public function suggestedProjectFromTeacher(){
            if(Auth::user()->role == 'admin'){

                $projects = Project::paginate(5);
                // $projects = $projects->paginate(5);

                return view('admin.suggestedProjectFromTeacher',compact(['projects']));
            }
            else{
                return redirect()->back();
            }
        }

        public function acceptProjectFromTeacher($id){
            if(Auth::user()->role == 'admin'){

                $project = Project::findOrFail($id);
                $project->isAccepted = null;
                $project->save();

                return redirect()->back()->with('success','The project was Accepted');

            }
            else{
                return redirect()->back();
            }
        }


        ///////////////////////////////////////

 public function allStudentsProjects(){
            if(Auth::user()->role == 'admin'){

            $projects = Project::where('isAddToDisc','=','1')->paginate(5);
            $teacher = Teacher::all();
            $user = User::all();

            $students = Student::all();
            $discussions = Discussion::all();


            return view('admin.allStudentsProjects',compact(['projects','teacher','user','students','discussions']));
            }
            else{
                return redirect()->back();
            }
        }

        ///////////////////////////////////////

        public function editProject($id){
            if(Auth::user()->role == 'admin'){

                $project = Project::findOrFail($id);
                return view('admin.editProject',compact('project'));

            }
                else{
                    return redirect()->back();
                }
        }

        ///////////////////////////////////////

        public function updateProject(Request $request, $id){
            if(Auth::user()->role == 'admin'){
                $request->validate([
                    'title' => 'required|string',
                    'type' => 'required|string',
                    'description' => 'required|string',
                    'explanatory' => 'required|file',

                ]
                    ,[

                        'title.required' => 'Title is required',
                        'title.string' => 'Title must be String',
                        'type.required' => 'Type is required',
                        'type.string' => 'Type must be String',
                        'description.required' => 'Description is required',
                        'description.string' => 'Description must be String',
                        'explanatory.required' => 'Explanatory is required',
                        'explanatory.file' => 'Explanatory must be File',

                    ]
            );
            $project = Project::findOrFail($id);
            $project->title = $request->input('title');
            $project->type = $request->input('type');
            $project->description = $request->input('description');

            $project['uuid'] = (string)Uuid::generate();
            if ($request->hasFile('explanatory')) {
                $project['explanatory'] = $request->explanatory->getClientOriginalName();
                $request->explanatory->storeAs('explanatories', $project['explanatory']);
            }

            $project->update();

            return redirect()->route('admin.showSuggestedProject')->with('success','Project is Updating Now');

            }
            else{
                return redirect()->back();
            }
        }

        ///////////////////////////////////////

        public function deleteProject($id){
            if(Auth::user()->role == 'admin'){

                $project = Project::findOrFail($id);
                $title = $project->title;
                $project->delete();

                return redirect()->back()->with('success',"Project ($title) is Deleted");

            }
            else{
                return redirect()->back();
            }

        }

    ///////////////////////////////////////   Discussions  ///////////////////////////////////////


        public function showAddDiscussions(){
            if(Auth::user()->role == 'admin'){

                $projects = Project::all();
                $teachers = Teacher::all();
                return view('admin.addDiscussions',compact(['projects','teachers']));
        }
            else{
                return redirect()->back();
            }

    }

    ///////////////////////////////////////

        public function addDiscussions(Request $request){
            if(Auth::user()->role == 'admin'){
                $request->validate([
                    'project_id' => 'required',
                    'teacher_id' => 'required',
                    'date' => 'required',
                    'time' => 'required',
                    'place' => 'required',
                ]
                    ,[

                        'project_id.required' => 'Project is required',
                        'teacher_id.string' => 'Teacher is required',
                        'date.required' => 'Date is required',
                        'time.required' => 'Time is required',
                        'place.required' => 'Place is required',
                    ]
            );

                $discussions = new Discussion();
                $discussions->project_id = $request->input('project_id');
                $id = Project::findOrFail($discussions->project_id);
                $id->isAddToDisc = 1;
                $discussions->student_id = $id->student_id;
                $id->save();
                $discussions->teacher_id = $request->input('teacher_id');
                $discussions->date = $request->input('date');
                $discussions->time = $request->input('time');
                $discussions->place = $request->input('place');

                $discussions->save();

                return redirect()->back()->with('success','Discussions is Adding Now');

        }
        else{
            return redirect()->back();
        }

    }
///////////////////////////////////////

    public function allDiscussions(){
        if(Auth::user()->role == 'admin'){

        $students = Student::all();
        $discussions = Discussion::all()->first();
        $discussions = $discussions->paginate(5);

        return view('admin.discussions',compact(['discussions','students']));
    }
        else{
            return redirect()->back();
        }
    }

    ///////////////////////////////////////

    public function editDiscussion($id){
        if(Auth::user()->role == 'admin'){
            $discussion = Discussion::findOrFail($id);
            $projects = Project::all();
            $teachers = Teacher::all();
            return view('admin.editDiscussion',compact(['discussion','projects','teachers']));
        }
        else{
            return redirect()->back();
        }
    }

    ///////////////////////////////////////

    public function updateDiscussion(Request $request , $id){
        if(Auth::user()->role == 'admin'){
            $request->validate([
                'project_id' => 'required',
                'teacher_id' => 'required',
                'date' => 'required',
                'time' => 'required',
                'place' => 'required',
            ]
                ,[

                    'project_id.required' => 'Project is required',
                    'teacher_id.string' => 'Teacher is required',
                    'date.required' => 'Date is required',
                    'time.required' => 'Time is required',
                    'place.required' => 'Place is required',
                ]
        );

                $discussions = Discussion::findOrFail($id);
                $discussions->project_id = $request->input('project_id');
                $discussions->teacher_id = $request->input('teacher_id');
                $discussions->date = $request->input('date');
                $discussions->time = $request->input('time');
                $discussions->place = $request->input('place');
                $discussions->update();

                return redirect()->back()->with('success','Discussion is Updating Now');


        }
        else{
            return redirect()->back();
        }
    }

    ///////////////////////////////////////

    public function deleteDiscussion($id){
        if(Auth::user()->role == 'admin'){

            $discussion = Discussion::findOrFail($id);
            $x = Project::findOrFail($discussion->project_id);
             $x->isAddToDisc = 0;
             $x->save();
            $discussion->delete();
            return redirect()->back()->with('success',"Discussion is Deleted");

        }
        else{
            return redirect()->back();
        }
    }




}




