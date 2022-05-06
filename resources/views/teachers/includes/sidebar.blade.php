<div id="sidebar-menu">
    <!-- Left Menu Start -->
    <ul class="metismenu list-unstyled" id="side-menu">
        <li class="menu-title">Menu</li>

     

        <li class = "{{request()->routeIs('teacher.quiz.*') ? 'mm-active' : ''}}">
            <a href="{{route('teacher.quiz.index')}}" class=" waves-effect">
                <i class="ri-calendar-2-line"></i>
                <span>{{__('sidebar.quizzes')}}</span>
            </a>
        </li>

         {{-- Attendance and Absence --}}
         <li>
            <a href="javascript: void(0);" class="has-arrow waves-effect">
                <i class="ri-account-circle-line"></i>
                <span>{{__('sidebar.attendance_and_absence')}}</span>
            </a>
            <ul class="sub-menu" aria-expanded="false">
                <li><a href="{{route('dashboard.absence_reason.index')}}">{{__('sidebar.absence_reasons')}}</a></li>
                <li><a href="{{route('dashboard.student_attendance.index')}}">{{__('sidebar.student_attendances')}}</a></li>
            </ul>
        </li>

    
    </ul>
</div>