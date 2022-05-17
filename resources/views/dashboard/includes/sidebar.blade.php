<div id="sidebar-menu">
    <!-- Left Menu Start -->
    <ul class="metismenu list-unstyled" id="side-menu">
        <li class="menu-title">{{__('general.menu')}}</li>

        @can('show.educational_stages')
        <li class = "{{request()->routeIs('dashboard.educational_stage.*') ? 'mm-active' : ''}}">
            <a href="{{route('dashboard.educational_stage.index')}}" class=" waves-effect">
                <i class="fas fa-university"></i>
                <span>{{__('sidebar.educational_stages')}}</span>
            </a>
        </li>
        @endcan

        @can('show.class_rooms')
        <li class = "{{request()->routeIs('dashboard.class_room.*') ? 'mm-active' : ''}}">
            <a href="{{route('dashboard.class_room.index')}}" class=" waves-effect">
                <i class="fas fa-network-wired"></i>
                <span>{{__('sidebar.class_rooms')}}</span>
            </a>
        </li>
        @endcan

        @can('show.educational_class_rooms')
        <li class = "{{request()->routeIs('dashboard.educational_class_room.*') ? 'mm-active' : ''}}">
            <a href="{{route('dashboard.educational_class_room.index')}}" class=" waves-effect">
                <i class="fas fa-layer-group"></i>
                <span>{{__('sidebar.educational_class_rooms')}}</span>
            </a>
        </li>
        @endcan

        
        @canany(['show.student_parents' , 'create.student_parent'])
        <li class = "{{request()->routeIs('dashboard.student_parent.*') ? 'mm-active' : ''}}">
            <a href="javascript: void(0);" class="has-arrow waves-effect {{request()->routeIs('dashboard.student_parent.*') ? 'mm-show' : ''}}">
                <i class="fas fa-user-tie"></i>
                <span>{{__('sidebar.parents')}}</span>
            </a>
            <ul class="sub-menu" aria-expanded="false">
                @can('show.student_parents')
                    <li><a href="{{route('dashboard.student_parent.index')}}">{{__('sidebar.parents_list')}}</a></li>
                @endcan
                @can('create.student_parent')
                    <li><a href="{{route('dashboard.student_parent.create')}}">{{__('sidebar.add_parent')}}</a></li>
                @endcan
            </ul>
        </li>
        @endcan

        {{--students --}}
        @canany(['show.students' , 'create.student' , 'show.student_upgrades' , 'show.graduated_students'])
        <li class = "{{request()->routeIs('dashboard.student.*') || request()->routeIs('dashboard.student_upgrade.*')  || request()->routeIs('dashboard.graduated_student.*')  ? 'mm-active' : ''}}">
            <a href="javascript: void(0);" class="has-arrow waves-effect {{request()->routeIs('dashboard.student.*') || request()->routeIs('dashboard.student_upgrade.*')  || request()->routeIs('dashboard.graduated_student.*')  ? 'mm-show' : ''}}">
                <i class="fas fa-user-friends"></i>
                <span>{{__('sidebar.students')}}</span>
            </a>
            <ul class="sub-menu" aria-expanded="false">
                @can('show.students')
                    <li><a href="{{route('dashboard.student.index')}}">{{__('sidebar.students_list')}}</a></li>
                @endcan

                @can('create.student')
                    <li><a href="{{route('dashboard.student.create')}}">{{__('sidebar.add_student')}}</a></li>
                @endcan

                @can('show.student_upgrades')
                    <li class = "{{request()->routeIs('dashboard.student_upgrade.*') ? 'mm-active' : ''}}">
                        <a href="{{route('dashboard.student_upgrade.index')}}">{{__('sidebar.student_upgrades')}}</a>
                    </li>
                @endcan

                @can('show.graduated_students')
                    <li class = "{{request()->routeIs('dashboard.graduated_student.*') ? 'mm-active' : ''}}">
                        <a href="{{route('dashboard.graduated_student.index')}}">{{__('sidebar.graduated_students')}}</a>
                    </li>
                @endcan
            </ul>
        </li>
        @endcan


        {{-- account management students --}}
        @canany(['show.study_fee_items' , 'show.study_fees' , 'show.student_invoices'])
        <li class = "{{request()->routeIs('dashboard.study_fee_item.*') || request()->routeIs('dashboard.study_fee.*')  || request()->routeIs('dashboard.student_invoice.*')  ? 'mm-active' : ''}}">
            <a href="javascript: void(0);" class="has-arrow waves-effect {{request()->routeIs('dashboard.study_fee_item.*') || request()->routeIs('dashboard.study_fee.*')  || request()->routeIs('dashboard.student_invoice.*')  ? 'mm-show' : ''}}">
                <i class="fas fa-money-bill-wave"></i>
                <span>{{__('sidebar.student_accounts_management')}}</span>
            </a>
            <ul class="sub-menu" aria-expanded="false">
                @can('show.study_fee_items')
                <li>
                    <a href="{{route('dashboard.study_fee_item.index')}}">{{__('sidebar.study_fee_items')}}</a>
                </li>
                @endcan
                @can('show.study_fees')
                <li class = "{{request()->routeIs('dashboard.study_fee.*') ? 'mm-active' : ''}}">
                    <a href="{{route('dashboard.study_fee.index')}}">{{__('sidebar.study_fees')}}</a>
                </li>
                @endcan

                @can('show.student_invoices')
                <li class = "{{request()->routeIs('dashboard.student_invoice.*') ? 'mm-active' : ''}}">
                    <a href="{{route('dashboard.student_invoice.index')}}">{{__('sidebar.student_invoices')}}</a>
                </li>
                @endcan
                
            </ul>
        </li>
        @endcan

         {{-- Attendance and Absence --}}
         @canany(['show.absence_reasons' , 'show.student_attendances'])
         <li class = "{{request()->routeIs('dashboard.absence_reason.*') || request()->routeIs('dashboard.student_attendance.*')  ? 'mm-active' : ''}}">
            <a href="javascript: void(0);" class="has-arrow waves-effect {{request()->routeIs('dashboard.absence_reason.*') || request()->routeIs('dashboard.student_attendance.*')  ? 'mm-show' : ''}}">
                <i class="fas fa-clipboard-check"></i>
                <span>{{__('sidebar.attendance_and_absence')}}</span>
            </a>
            <ul class="sub-menu" aria-expanded="false">
                @can('show.absence_reasons')
                    <li><a href="{{route('dashboard.absence_reason.index')}}">{{__('sidebar.absence_reasons')}}</a></li>
                @endcan

                @can('show.student_attendances')
                    <li class = "{{request()->routeIs('dashboard.student_attendance.*') ? 'mm-active' : ''}}">
                        <a href="{{route('dashboard.student_attendance.index')}}">{{__('sidebar.student_attendances')}}</a>
                    </li>
                @endcan
            </ul>
        </li>
        @endcan

        {{-- subjects --}}
        @can('show.subjects')
        <li class = "{{request()->routeIs('dashboard.subject.*') ? 'mm-active' : ''}}">
            <a href="{{route('dashboard.subject.index')}}" class=" waves-effect">
                <i class="fas fa-id-badge"></i>
                <span>{{__('sidebar.subjects')}}</span>
            </a>
        </li>
        @endcan
        

        {{-- Faculty --}}
        @canany(['show.teachers' , 'create.teacher'])
        <li class = "{{request()->routeIs('dashboard.teacher.*')  ? 'mm-active' : ''}}">
            <a href="javascript: void(0);" class="has-arrow waves-effect {{request()->routeIs('dashboard.teacher.*')  ? 'mm-show' : ''}}">
                <i class="fas fa-chalkboard-teacher"></i>
                <span>{{__('sidebar.faculty')}}</span>
            </a>
            <ul class="sub-menu" aria-expanded="false">
                @can('show.teachers')
                    <li><a href="{{route('dashboard.teacher.index')}}">{{__('sidebar.teachers')}}</a></li>
                @endcan

                @can('create.teacher')
                    <li><a href="{{route('dashboard.teacher.create')}}">{{__('sidebar.add_teacher')}}</a></li>
                @endcan
            </ul>
        </li>
        @endcan

        {{-- School Management --}}
        @canany(['edit.school_management' , 'edit.system_setting'])
        <li class = "{{request()->routeIs('dashboard.school_data.*')  ? 'mm-active' : ''}}">
            <a href="javascript: void(0);" class="has-arrow waves-effect {{request()->routeIs('dashboard.school_data.*')  ? 'mm-show' : ''}}">
                <i class=" fas fa-school"></i>
                <span>{{__('sidebar.school_management')}}</span>
            </a>
            <ul class="sub-menu" aria-expanded="false">
                @can('edit.school_management')
                    <li><a href="{{route('dashboard.school_data.edit')}}">{{__('sidebar.school_data')}}</a></li>
                @endcan

                @can('edit.system_setting')
                    <li><a href="{{route('dashboard.system_setting.edit')}}">{{__('sidebar.system_setting')}}</a></li>
                @endcan
            </ul>
        </li>
        @endcan

        {{-- User Management --}}
        @canany(['show.roles' , 'show.users'])
        <li class = "{{request()->routeIs('dashboard.role.*')  ? 'mm-active' : ''}}">
            <a href="javascript: void(0);" class="has-arrow waves-effect {{request()->routeIs('dashboard.role.*')  ? 'mm-show' : ''}}">
                <i class="fas fa-user-cog"></i>
                <span>{{__('sidebar.user_management')}}</span>
            </a>
            <ul class="sub-menu" aria-expanded="false">
                @can('show.roles')
                <li class = "{{request()->routeIs('dashboard.role.*') ? 'mm-active' : ''}}">
                    <a href="{{route('dashboard.role.index')}}">{{__('sidebar.roles')}}</a>
                </li>
                @endcan

                @can('show.users')
                <li class = "{{request()->routeIs('dashboard.user.*') ? 'mm-active' : ''}}">
                    <a href="{{route('dashboard.user.index')}}">{{__('sidebar.users')}}</a>
                </li>
                @endcan
                
            </ul>
        </li>
        @endcan

    </ul>
</div>