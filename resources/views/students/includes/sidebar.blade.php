<div id="sidebar-menu">
    <!-- Left Menu Start -->
    <ul class="metismenu list-unstyled" id="side-menu">
        <li class="menu-title">Menu</li>



        {{-- Online Classes --}}
        <li class = "{{request()->routeIs('student.online_class.*') ? 'mm-active' : ''}}">
            <a href="{{route('student.online_class.index')}}" class=" waves-effect">
                <i class="ri-calendar-2-line"></i>
                <span>{{__('sidebar.online_classes')}}</span>
            </a>
        </li>

        {{-- Quizzes --}}
        <li class = "{{request()->routeIs('student.quiz.*') ? 'mm-active' : ''}}">
            <a href="{{route('student.quiz.index')}}" class=" waves-effect">
                <i class="ri-calendar-2-line"></i>
                <span>{{__('sidebar.quizzes')}}</span>
            </a>
        </li>

         {{-- Subjects Subjects --}}
         <li>
            <a href="javascript: void(0);" class="has-arrow waves-effect">
                <i class="ri-account-circle-line"></i>
                <span>{{__('sidebar.my_courses')}}</span>
            </a>
            <ul class="sub-menu" aria-expanded="false">
                @php 
                    $subjects = \App\Models\Subject::where('class_room_id' , auth()->guard('student')->user()->class_room_id   )->get();
                @endphp
                @foreach($subjects as $subject)
                    <li><a href="{{route('student.subject.show' , $subject->id)}}">{{ $subject->name }}</a></li>
                @endforeach
            </ul>
        </li>



      
    
    </ul>
</div>