<div id="sidebar-menu">
    <!-- Left Menu Start -->
    <ul class="metismenu list-unstyled" id="side-menu">
        <li class="menu-title">Menu</li>

     
        {{-- Quizzes --}}
        <li class = "{{request()->routeIs('teacher.quiz.*') ? 'mm-active' : ''}}">
            <a href="{{route('teacher.quiz.index')}}" class=" waves-effect">
                <i class="ri-calendar-2-line"></i>
                <span>{{__('sidebar.quizzes')}}</span>
            </a>
        </li>

        {{-- Attendance and Absence --}}
        <li class = "{{request()->routeIs('teacher.student_attendance.*') ? 'mm-active' : ''}}">
            <a href="{{route('teacher.student_attendance.index')}}" class=" waves-effect">
                <i class="ri-calendar-2-line"></i>
                <span>{{__('sidebar.student_attendances')}}</span>
            </a>
        </li>


    
    </ul>
</div>