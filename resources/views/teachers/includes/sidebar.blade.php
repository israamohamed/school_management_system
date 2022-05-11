<div id="sidebar-menu">
    <!-- Left Menu Start -->
    <ul class="metismenu list-unstyled" id="side-menu">
        <li class="menu-title">Menu</li>

     
        {{-- Quizzes --}}
        <li class = "{{request()->routeIs('teacher.quiz.*') ? 'mm-active' : ''}}">
            <a href="{{route('teacher.quiz.index')}}" class=" waves-effect">
                <i class="far fa-question-circle"></i>
                <span>{{__('sidebar.quizzes')}}</span>
            </a>
        </li>

        {{-- Attendance and Absence --}}
        <li class = "{{request()->routeIs('teacher.student_attendance.*') ? 'mm-active' : ''}}">
            <a href="{{route('teacher.student_attendance.index')}}" class=" waves-effect">
                <i class="fas fa-clipboard-check"></i>
                <span>{{__('sidebar.student_attendances')}}</span>
            </a>
        </li>

        {{-- Online Classes --}}
        <li class = "{{request()->routeIs('teacher.online_class.*') ? 'mm-active' : ''}}">
            <a href="{{route('teacher.online_class.index')}}" class=" waves-effect">
                <i class="fas fa-globe"></i>
                <span>{{__('sidebar.online_classes')}}</span>
            </a>
        </li>

        {{-- Teacher Subjects --}}
        <li>
            <a href="javascript: void(0);" class="has-arrow waves-effect">
                <i class="fas fa-id-badge"></i>
                <span>{{__('sidebar.subjects')}}</span>
            </a>
            <ul class="sub-menu" aria-expanded="false">
                @foreach(auth()->guard('teacher')->user()->subjects as $subject)
                    <li><a href="{{route('teacher.subject.show' , $subject->id)}}">{{ $subject->name_in_details }}</a></li>
                @endforeach
            </ul>
        </li>


    
    </ul>
</div>