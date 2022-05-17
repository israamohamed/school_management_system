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

            'show.student_upgrades',
            'create.student_upgrade',
            'delete.student_upgrade',

            'show.graduated_students',
            'create.graduated_student',
            'delete.graduated_student',

            'show.study_fee_items',
            'create.study_fee_item',
            'edit.study_fee_item',
            'delete.study_fee_item',

            'show.study_fees',
            'create.study_fee',
            'edit.study_fee',
            'delete.study_fee',

            'show.student_invoices',
            'create.student_invoice',
            'edit.student_invoice',
            'delete.student_invoice',

            'show.financial_bonds',
            'create.financial_bond',
            'edit.financial_bond',
            'delete.financial_bond',

            'show.absence_reasons',
            'create.absence_reason',
            'edit.absence_reason',
            'delete.absence_reason',

            'show.student_attendances',
            'create.student_attendance',

            'show.subjects',
            'create.subject',
            'edit.subject',
            'delete.subject',

            'show.teachers',
            'create.teacher',
            'edit.teacher',
            'delete.teacher',

            'edit.school_management',
            'edit.system_setting',

            'show.roles',
            'create.role',
            'edit.role',
            'delete.role',

            'show.users',
            'create.user',
            'edit.user',
            'delete.user',


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

            ['en' => 'show    student upgrades' , 'ar' => 'عرض شاشة ترحيل الطلاب'],
            ['en' => 'create  student upgrade' , 'ar' => 'إضافة ترحيل الطلاب'],
            ['en' => 'delete  student upgrade' , 'ar' => 'إرجاع ترحيل الطلاب'],

            ['en' => 'show    graduated students' , 'ar' => 'عرض الطلاب المتخرجين'],
            ['en' => 'create  graduated student' , 'ar' => 'إضافة تخرج طالب'],
            ['en' => 'delete  graduated student' , 'ar' => 'إرجاع تخرج الطالب'],

            ['en' => 'show    study fee items' , 'ar' => 'عرض بنود الرسوم'],
            ['en' => 'create  study fee item' , 'ar' => 'إضافة بند دراسي'],
            ['en' => 'edit    study fee item' , 'ar' => 'تعديل بند دراسي'],
            ['en' => 'delete  study fee item' , 'ar' => 'حذف بند دراسي'],

            ['en' => 'show    study fees' , 'ar' => 'عرض الرسوم الدراسية'],
            ['en' => 'create  study fee' , 'ar' => 'إضافة رسوم دراسية'],
            ['en' => 'edit    study fee' , 'ar' => 'تعديل رسوم دراسية'],
            ['en' => 'delete  study fee' , 'ar' => 'حذف رسوم دراسية'],

            ['en' => 'show    student invoices' , 'ar' => 'عرض فواتير الطلاب'],
            ['en' => 'create  student invoice' , 'ar' => 'إضافة فاتورة للطالب'],
            ['en' => 'edit    student invoice' , 'ar' => 'تعديل فاتورة للطالب'],
            ['en' => 'delete  student invoice' , 'ar' => 'حذف فاتورة للطالب'],

            ['en' => 'show    financial bonds' , 'ar' => 'عرض السندات المالية'],
            ['en' => 'create  financial bond' , 'ar' => 'إضافة سند مالي للطالب'],
            ['en' => 'edit    financial bond' , 'ar' => 'تعديل سند مالي للطالب'],
            ['en' => 'delete  financial bond' , 'ar' => 'حذف سند مالي للطالب'],

            ['en' => 'show    absence reasons' , 'ar' => 'عرض أسباب الغياب'],
            ['en' => 'create  absence reason' , 'ar' => 'إضافة سبب غياب'],
            ['en' => 'edit    absence reason' , 'ar' => 'تعديل سبب غياب'],
            ['en' => 'delete  absence reason' , 'ar' => 'حذف سبب غياب'],

            ['en' => 'show    student attendances' , 'ar' => 'عرض الغياب والحضور'],
            ['en' => 'create  student attendance' , 'ar' => 'إضافة الغياب والحضور'],

            ['en' => 'show    subjects' , 'ar' => 'عرض المواد الدراسية'],
            ['en' => 'create  subject' , 'ar' => 'إضافة مادة دراسية'],
            ['en' => 'edit    subject' , 'ar' => 'تعديل مادة دراسية'],
            ['en' => 'delete  subject' , 'ar' => 'حذف مادة دراسية'],

            ['en' => 'show    teachers' , 'ar' => 'عرض المعلمين'],
            ['en' => 'create  teacher' , 'ar' => 'إضافة معلم'],
            ['en' => 'edit    teacher' , 'ar' => 'تعديل معلم'],
            ['en' => 'delete  teacher' , 'ar' => 'حذف معلم'],

            ['en' => 'edit    school data' , 'ar' => 'تعديل بيانات المدرسة'],

            ['en' => 'edit  system settings' , 'ar' => 'ضبط إعدادات النظام'],

            ['en' => 'show    roles' , 'ar' => 'عرض الوظائف'],
            ['en' => 'create  role' , 'ar' => 'إضافة وظيفة'],
            ['en' => 'edit    role' , 'ar' => 'تعديل وظيفة'],
            ['en' => 'delete  role' , 'ar' => 'حذف وظيفة'],

            ['en' => 'show    users' , 'ar' => 'عرض الموظفين'],
            ['en' => 'create  user' , 'ar' => 'إضافة موظف'],
            ['en' => 'edit    user' , 'ar' => 'تعديل موظف'],
            ['en' => 'delete  user' , 'ar' => 'حذف موظف'],
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


            'dashboard.student_upgrade.index',
            'dashboard.student_upgrade.create,dashboard.student_upgrade.store',
            'dashboard.student_upgrade.destroy,dashboard.student_upgrade.return_multiple_students',

            'dashboard.graduated_student.index',
            'dashboard.graduated_student.create,dashboard.graduated_student.store',
            'dashboard.graduated_student.destroy,dashboard.graduated_student.return_multiple_students',

            'dashboard.study_fee_item.index,dashboard.study_fee_item.show',
            'dashboard.study_fee_item.create,dashboard.study_fee_item.store',
            'dashboard.study_fee_item.edit,dashboard.study_fee_item.update,',
            'dashboard.study_fee_item.destroy',

            'dashboard.study_fee.index,dashboard.study_fee.show',
            'dashboard.study_fee.create,dashboard.study_fee.store',
            'dashboard.study_fee.edit,dashboard.study_fee.update,',
            'dashboard.study_fee.destroy',

            'dashboard.student_invoice.index,dashboard.student_invoice.show',
            'dashboard.student_invoice.create,dashboard.student_invoice.store',
            'dashboard.student_invoice.edit,dashboard.student_invoice.update,',
            'dashboard.student_invoice.destroy',

            'dashboard.financial_bond.index,dashboard.financial_bond.show',
            'dashboard.financial_bond.create,dashboard.financial_bond.store',
            'dashboard.financial_bond.edit,dashboard.financial_bond.update,',
            'dashboard.financial_bond.destroy',

            'dashboard.absence_reason.index,dashboard.absence_reason.show',
            'dashboard.absence_reason.create,dashboard.absence_reason.store',
            'dashboard.absence_reason.edit,dashboard.absence_reason.update,',
            'dashboard.absence_reason.destroy',

            'dashboard.student_attendance.index,dashboard.student_attendance.show',
            'dashboard.student_attendance.create,dashboard.student_attendance.store',

            'dashboard.subject.index,dashboard.subject.show',
            'dashboard.subject.create,dashboard.subject.store',
            'dashboard.subject.edit,dashboard.subject.update,',
            'dashboard.subject.destroy',

            'dashboard.teacher.index,dashboard.teacher.show',
            'dashboard.teacher.create,dashboard.teacher.store',
            'dashboard.teacher.edit,dashboard.teacher.update,',
            'dashboard.teacher.destroy',

            'dashboard.school_data.edit,dashboard.school_data.update',
            'dashboard.system_setting.edit,dashboard.system_setting.update',

            'dashboard.role.index,dashboard.role.show',
            'dashboard.role.create,dashboard.role.store',
            'dashboard.role.edit,dashboard.role.update,',
            'dashboard.role.destroy',

            'dashboard.user.index,dashboard.user.show',
            'dashboard.user.create,dashboard.user.store',
            'dashboard.user.edit,dashboard.user.update,',
            'dashboard.user.destroy',
        ];

        $groups = [
            '1', '1', '1', '1', //educational stage
            '2', '2', '2', '2', //class room
            '3', '3', '3', '3', //educational class room
            '4', '4', '4', '4', //parents
            '5', '5', '5', '5', '5', '5', '5', '5', '5', '5', '5', '5', '5', //student
            '6', '6', '6', '6', //study fee item
            '7', '7', '7', '7', //study fee
            '8', '8', '8', '8', //student invoice
            '9', '9', '9', '9', //student invoice
            '10', '10', '10', '10', //absence reason
            '10', '10',           //attendance
            '11', '11', '11', '11', //subjects
            '12', '12', '12', '12', //teachers
            '13', '13',             //school settings
            '14', '14', '14', '14','14', '14', '14', '14', //users && roles
            
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
