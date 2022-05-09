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


     
        {{-- Quizzes --}}
        {{-- <li class = "{{request()->routeIs('teacher.quiz.*') ? 'mm-active' : ''}}">
            <a href="{{route('teacher.quiz.index')}}" class=" waves-effect">
                <i class="ri-calendar-2-line"></i>
                <span>{{__('sidebar.quizzes')}}</span>
            </a>
        </li> --}}

      
    
    </ul>
</div>