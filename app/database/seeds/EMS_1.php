<?php

class EMS extends Seeder {

    public function run() {
        //drop all recordsets
        DB::table('users')->delete();
        User::create(array(
            'name' => 'Administrator',
            'username' => 'admin',
            'email' => 'admin@esm.vn',
            'password' => Hash::make('admin'),
        ));

        //drop all recordsets
        //field_types
        DB::table('field_types')->insert(
                array(
                    //single value
                    array('id' => 1, 'name' => 'Text Field', 'groupId' => 1, 'group' => 'Single Value', 'display' => 'textfield'),
                    array('id' => 2, 'name' => 'Text Area', 'groupId' => 1, 'group' => 'Single Value', 'display' => 'textarea'),
                    array('id' => 3, 'name' => 'Image', 'groupId' => 1, 'group' => 'Single Value', 'display' => 'textfield'),
                    array('id' => 4, 'name' => 'Audio', 'groupId' => 1, 'group' => 'Single Value', 'display' => 'textarea'),
                    array('id' => 5, 'name' => 'Video', 'groupId' => 1, 'group' => 'Single Value', 'display' => 'textfield'),
                    array('id' => 6, 'name' => 'File Attachment', 'groupId' => 1, 'group' => 'Single Value', 'display' => 'textarea'),
                    array('id' => 7, 'name' => 'Dropdown', 'groupId' => 2, 'group' => 'Multiple Value - Single Select', 'display' => 'dropdown'),
                    array('id' => 8, 'name' => 'Radiobox', 'groupId' => 2, 'group' => 'Multiple Value - Single Select', 'display' => 'radio'),
                    array('id' => 9, 'name' => 'Listbox', 'groupId' => 3, 'group' => 'Multiple Value - Multiple Select', 'display' => 'list'),
                    array('id' => 10, 'name' => 'Checkbox', 'groupId' => 3, 'group' => 'Multiple Value - Multiple Select', 'display' => 'checkbox'),
                )
        );


        DB::table('fields')->insert(
                array(
                    array('id' => 1, 'name' => 'Student name', 'field_type_id' => 1, 'value_type' => '0'),
                    array('id' => 2, 'name' => 'Student bod', 'field_type_id' => 1, 'value_type' => '0'),
                    array('id' => 3, 'name' => 'Class name', 'field_type_id' => 1, 'value_type' => '0'),
                    array('id' => 4, 'name' => 'Class description', 'field_type_id' => 1, 'value_type' => '0'),
                    array('id' => 5, 'name' => 'Subject name', 'field_type_id' => 1, 'value_type' => '0'),
                    array('id' => 6, 'name' => 'Subject level', 'field_type_id' => 1, 'value_type' => '0'),
                    array('id' => 7, 'name' => 'Mark name', 'field_type_id' => 1, 'value_type' => '0'),
                    array('id' => 8, 'name' => 'Mark level', 'field_type_id' => 1, 'value_type' => '0'),
                    array('id' => 100, 'name' => 'Text field', 'field_type_id' => 1, 'value_type' => '0'),
                    array('id' => 101, 'name' => 'Text Area', 'field_type_id' => 2, 'value_type' => '0'),
                    array('id' => 103, 'name' => 'Image', 'field_type_id' => 3, 'value_type' => '0'),
                    array('id' => 104, 'name' => 'Audio', 'field_type_id' => 4, 'value_type' => '0'),
                    array('id' => 105, 'name' => 'Video', 'field_type_id' => 5, 'value_type' => '0'),
                    array('id' => 106, 'name' => 'File Attachment', 'field_type_id' => 6, 'value_type' => '0'),
                    array('id' => 107, 'name' => 'Drop down', 'field_type_id' => 7, 'value_type' => '1'),
                    array('id' => 108, 'name' => 'Radio', 'field_type_id' => 8, 'value_type' => '1'),
                    array('id' => 109, 'name' => 'Listbox', 'field_type_id' => 9, 'value_type' => '1'),
                    array('id' => 110, 'name' => 'Checkbox', 'field_type_id' => 10, 'value_type' => '1'),
                )
        );

        //field_define_values
        DB::table('field_define_values')->insert(
                array(
                    //single value
                    array('field_id' => 107, 'value' => 'Drop down 1'),
                    array('field_id' => 107, 'value' => 'Drop down 2'),
                    array('field_id' => 107, 'value' => 'Drop down 3'),
                    array('field_id' => 107, 'value' => 'Drop down 4'),
                    array('field_id' => 108, 'value' => 'Radio 1'),
                    array('field_id' => 108, 'value' => 'Radio 2'),
                    array('field_id' => 108, 'value' => 'Radio 3'),
                    array('field_id' => 108, 'value' => 'Radio 4'),
                    array('field_id' => 109, 'value' => 'Listbox 1'),
                    array('field_id' => 109, 'value' => 'Listbox 2'),
                    array('field_id' => 109, 'value' => 'Listbox 3'),
                    array('field_id' => 109, 'value' => 'Listbox 4'),
                    array('field_id' => 110, 'value' => 'Checkbox 1'),
                    array('field_id' => 110, 'value' => 'Checkbox 2'),
                    array('field_id' => 110, 'value' => 'Checkbox 3'),
                    array('field_id' => 110, 'value' => 'Checkbox 4'),
                )
        );



        //groups
        DB::table('groups')->insert(
                array(
                    //single value
                    array('id' => 1, 'name' => 'Student', 'link' => 'student', 'icon' => 'icon-home'),
                    array('id' => 2, 'name' => 'Class', 'link' => 'class', 'icon' => 'icon-home'),
                    array('id' => 3, 'name' => 'Subject', 'link' => 'subject', 'icon' => 'icon-home'),
                    array('id' => 4, 'name' => 'Mark', 'link' => 'mark', 'icon' => 'icon-home'),
                    array('id' => 5, 'name' => 'Sample Group', 'link' => 'sample-group', 'icon' => 'icon-home'),
                )
        );

        DB::table('group_fields')->insert(
                array(
                    array('group_id' => 1, 'field_id' => 1),
                    array('group_id' => 2, 'field_id' => 3),
                    array('group_id' => 3, 'field_id' => 5),
                    array('group_id' => 4, 'field_id' => 7),
                    array('group_id' => 5, 'field_id' => 100),
                    array('group_id' => 5, 'field_id' => 101),
                    array('group_id' => 5, 'field_id' => 103),
                    array('group_id' => 5, 'field_id' => 104),
                    array('group_id' => 5, 'field_id' => 105),
                    array('group_id' => 5, 'field_id' => 106),
                    array('group_id' => 5, 'field_id' => 107),
                    array('group_id' => 5, 'field_id' => 108),
                    array('group_id' => 5, 'field_id' => 109),
                    array('group_id' => 5, 'field_id' => 110),
                )
        );

        DB::table('entities')->insert(
                array(
                    array('id' => 1, 'group_id' => '5', 'name' => 'Entity 1 - Group 5'),
                    array('id' => 2, 'group_id' => '5', 'name' => 'Entity 2 - Group 5'),
                    array('id' => 3, 'group_id' => '5', 'name' => 'Entity 3 - Group 5'),
                    array('id' => 4, 'group_id' => '5', 'name' => 'Entity 4 - Group 5'),
                )
        );
    }

}
