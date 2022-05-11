<div id="sidebar-menu">
    <!-- Left Menu Start -->
    <ul class="metismenu list-unstyled" id="side-menu">
        <li class="menu-title">{{__('general.menu')}}</li>

        <li class = "{{request()->routeIs('dashboard.educational_stage.*') ? 'mm-active' : ''}}">
            <a href="{{route('dashboard.educational_stage.index')}}" class=" waves-effect">
                <i class="fas fa-university"></i>
                <span>{{__('sidebar.educational_stages')}}</span>
            </a>
        </li>

        <li class = "{{request()->routeIs('dashboard.class_room.*') ? 'mm-active' : ''}}">
            <a href="{{route('dashboard.class_room.index')}}" class=" waves-effect">
                <i class="fas fa-network-wired"></i>
                <span>{{__('sidebar.class_rooms')}}</span>
            </a>
        </li>

        <li class = "{{request()->routeIs('dashboard.educational_class_room.*') ? 'mm-active' : ''}}">
            <a href="{{route('dashboard.educational_class_room.index')}}" class=" waves-effect">
                <i class="fas fa-layer-group"></i>
                <span>{{__('sidebar.educational_class_rooms')}}</span>
            </a>
        </li>

        <li class = "{{request()->routeIs('dashboard.student_parent.*') ? 'mm-active' : ''}}">
            <a href="javascript: void(0);" class="has-arrow waves-effect {{request()->routeIs('dashboard.student_parent.*') ? 'mm-show' : ''}}">
                <i class="fas fa-user-tie"></i>
                <span>{{__('sidebar.parents')}}</span>
            </a>
            <ul class="sub-menu" aria-expanded="false">
                <li><a href="{{route('dashboard.student_parent.index')}}">{{__('sidebar.parents_list')}}</a></li>
                <li><a href="{{route('dashboard.student_parent.create')}}">{{__('sidebar.add_parent')}}</a></li>
            </ul>
        </li>

        {{--students --}}
        <li class = "{{request()->routeIs('dashboard.student.*') || request()->routeIs('dashboard.student_upgrade.*')  || request()->routeIs('dashboard.graduated_student.*')  ? 'mm-active' : ''}}">
            <a href="javascript: void(0);" class="has-arrow waves-effect {{request()->routeIs('dashboard.student.*') || request()->routeIs('dashboard.student_upgrade.*')  || request()->routeIs('dashboard.graduated_student.*')  ? 'mm-show' : ''}}">
                <i class="fas fa-user-friends"></i>
                <span>{{__('sidebar.students')}}</span>
            </a>
            <ul class="sub-menu" aria-expanded="false">
                <li><a href="{{route('dashboard.student.index')}}">{{__('sidebar.students_list')}}</a></li>
                <li><a href="{{route('dashboard.student.create')}}">{{__('sidebar.add_student')}}</a></li>

                <li class = "{{request()->routeIs('dashboard.student_upgrade.*') ? 'mm-active' : ''}}">
                    <a href="{{route('dashboard.student_upgrade.index')}}">{{__('sidebar.student_upgrades')}}</a>
                </li>

                <li class = "{{request()->routeIs('dashboard.graduated_student.*') ? 'mm-active' : ''}}">
                    <a href="{{route('dashboard.graduated_student.index')}}">{{__('sidebar.graduated_students')}}</a>
                </li>
            </ul>
        </li>


        {{-- account management students --}}
        <li class = "{{request()->routeIs('dashboard.study_fee_item.*') || request()->routeIs('dashboard.study_fee.*')  || request()->routeIs('dashboard.student_invoice.*')  ? 'mm-active' : ''}}">
            <a href="javascript: void(0);" class="has-arrow waves-effect {{request()->routeIs('dashboard.study_fee_item.*') || request()->routeIs('dashboard.study_fee.*')  || request()->routeIs('dashboard.student_invoice.*')  ? 'mm-show' : ''}}">
                <i class="fas fa-money-bill-wave"></i>
                <span>{{__('sidebar.student_accounts_management')}}</span>
            </a>
            <ul class="sub-menu" aria-expanded="false">
                <li>
                    <a href="{{route('dashboard.study_fee_item.index')}}">{{__('sidebar.study_fee_items')}}</a>
                </li>
                <li class = "{{request()->routeIs('dashboard.study_fee.*') ? 'mm-active' : ''}}">
                    <a href="{{route('dashboard.study_fee.index')}}">{{__('sidebar.study_fees')}}</a>
                </li>
                <li class = "{{request()->routeIs('dashboard.student_invoice.*') ? 'mm-active' : ''}}">
                    <a href="{{route('dashboard.student_invoice.index')}}">{{__('sidebar.student_invoices')}}</a>
                </li>
                
            </ul>
        </li>

         {{-- Attendance and Absence --}}
         <li class = "{{request()->routeIs('dashboard.absence_reason.*') || request()->routeIs('dashboard.student_attendance.*')  ? 'mm-active' : ''}}">
            <a href="javascript: void(0);" class="has-arrow waves-effect {{request()->routeIs('dashboard.absence_reason.*') || request()->routeIs('dashboard.student_attendance.*')  ? 'mm-show' : ''}}">
                <i class="fas fa-clipboard-check"></i>
                <span>{{__('sidebar.attendance_and_absence')}}</span>
            </a>
            <ul class="sub-menu" aria-expanded="false">
                <li><a href="{{route('dashboard.absence_reason.index')}}">{{__('sidebar.absence_reasons')}}</a></li>
                <li class = "{{request()->routeIs('dashboard.student_attendance.*') ? 'mm-active' : ''}}">
                    <a href="{{route('dashboard.student_attendance.index')}}">{{__('sidebar.student_attendances')}}</a>
                </li>
            </ul>
        </li>

        {{-- subjects --}}
        <li class = "{{request()->routeIs('dashboard.subject.*') ? 'mm-active' : ''}}">
            <a href="{{route('dashboard.subject.index')}}" class=" waves-effect">
                <i class="fas fa-id-badge"></i>
                <span>{{__('sidebar.subjects')}}</span>
            </a>
        </li>
        

        {{-- Faculty --}}
        <li class = "{{request()->routeIs('dashboard.teacher.*')  ? 'mm-active' : ''}}">
            <a href="javascript: void(0);" class="has-arrow waves-effect {{request()->routeIs('dashboard.teacher.*')  ? 'mm-show' : ''}}">
                <i class="fas fa-chalkboard-teacher"></i>
                <span>{{__('sidebar.faculty')}}</span>
            </a>
            <ul class="sub-menu" aria-expanded="false">
                <li><a href="{{route('dashboard.teacher.index')}}">{{__('sidebar.teachers')}}</a></li>
                <li><a href="{{route('dashboard.teacher.create')}}">{{__('sidebar.add_teacher')}}</a></li>
            </ul>
        </li>

    </ul>
</div>