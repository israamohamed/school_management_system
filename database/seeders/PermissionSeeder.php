<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        

        $names = [
            'show.educational_stages',
            'create.educational_stage',
            'edit.educational_stage',
            'delete.educational_stage',

            'show.class_rooms',
            'create.class_room',
            'edit.class_room',
            'delete.class_room',

            'show.educational_class_rooms',
            'create.educational_class_room',
            'edit.educational_class_room',
            'delete.educational_class_room',

            'show.student_parents',
            'create.student_parent',
            'edit.student_parent',
            'delete.student_parent',

            'show.students',
            'create.student',
            'edit.student',
            'delete.student',
            'delete.student_attachment',
            'download.student_attachment',
            'store.student_attachment',


        ];
        $display_names = [
            ['en' => 'show    educational stages' , 'ar' => 'عرض المراحل التعليمية'],
            ['en' => 'create  educational stage' , 'ar' => 'إضافة مرحلة تعليمية'],
            ['en' => 'edit    educational stage' , 'ar' => 'تعديل مرحلة تعليمية'],
            ['en' => 'delete  educational stage' , 'ar' => 'حذف مرحلة تعليمية'],

            ['en' => 'show    class rooms' , 'ar' => 'عرض الصفوف الدراسية'],
            ['en' => 'create  class room' , 'ar' => 'إضافة صف دراسي'],
            ['en' => 'edit    class room' , 'ar' => 'تعديل صف دراسي'],
            ['en' => 'delete  class room' , 'ar' => 'حذف صف دراسي'],

            ['en' => 'show    educational class rooms' , 'ar' => 'عرض الفصول الدراسية'],
            ['en' => 'create  educational class room' , 'ar' => 'إضافة فصل دراسي'],
            ['en' => 'edit    educational class room' , 'ar' => 'تعديل فصل دراسي'],
            ['en' => 'delete  educational class room' , 'ar' => 'حذف فصل دراسي'],


            ['en' => 'show    parents' , 'ar' => 'عرض أولياء الأمور'],
            ['en' => 'create  parent' , 'ar' => 'إضافة ولي أمر'],
            ['en' => 'edit    parent' , 'ar' => 'تعديل ولي الأمر'],
            ['en' => 'delete  parent' , 'ar' => 'حذف ولي الأمر'],

            ['en' => 'show    students' , 'ar' => 'عرض الطلاب'],
            ['en' => 'create  student' , 'ar' => 'إضافة طالب'],
            ['en' => 'edit    student' , 'ar' => 'تعديل طالب'],
            ['en' => 'delete  student' , 'ar' => 'حذف طالب'],
            ['en' => 'delete student attachments'   , 'ar' => 'حذف مرفقات الطالب'],
            ['en' => 'download student attachments' , 'ar' => 'تحميل مرفقات الطالب'],
            ['en' => 'add student attachments'      , 'ar' => 'إضافة مرفقات للطالب'],
        ];
    
        $routes = [
            'dashboard.educational_stage.index,dashboard.educational_stage.show',
            'dashboard.educational_stage.create,dashboard.educational_stage.store',
            'dashboard.educational_stage.edit,dashboard.educational_stage.update,',
            'dashboard.educational_stage.destroy',

            'dashboard.class_room.index,dashboard.class_room.show',
            'dashboard.class_room.create,dashboard.class_room.store',
            'dashboard.class_room.edit,dashboard.class_room.update,',
            'dashboard.class_room.destroy,dashboard',

            
            'dashboard.educational_class_room.index,dashboard.educational_class_room.show',
            'dashboard.educational_class_room.create,dashboard.educational_class_room.store',
            'dashboard.educational_class_room.edit,dashboard.educational_class_room.update,',
            'dashboard.educational_class_room.destroy',

            'dashboard.student_parent.index,dashboard.student_parent.show',
            'dashboard.student_parent.create,dashboard.student_parent.store',
            'dashboard.student_parent.edit,dashboard.student_parent.update,',
            'dashboard.student_parent.destroy,dashboard.student_parent.delete_selected',

            
            'dashboard.student.index,dashboard.student.show',
            'dashboard.student.create,dashboard.student.store',
            'dashboard.student.edit,dashboard.student.update,',
            'dashboard.student.destroy,dashboard.student.delete_selected',

            'dashboard.student.delete_attachment',
            'dashboard.student.download_attachment,',
            'dashboard.student.store_attachments',
        ];

        $groups = [
            '1', '1', '1', '1', //educational stage
            '2', '2', '2', '2', //class room
            '3', '3', '3', '3', //educational class room
            '4', '4', '4', '4', //parents
            '5', '5', '5', '5', '5', '5', '5', //student
        ];



        DB::table('permissions')->delete();
        for($i = 0; $i < count($names);  $i++ )
        {
            Permission::create([
                'name'           => $names[$i],
                'display_name'   => $display_names[$i],
                'guard_name'     => 'web',
                'routes'         => $routes[$i],
                'group'          => $groups[$i],

            ]);
        }
        
    }
}
