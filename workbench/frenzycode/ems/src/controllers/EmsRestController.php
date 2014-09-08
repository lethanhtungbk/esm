<?php
namespace Frenzycode\Ems\Controllers;
/* ---------------------------- */
/*        GLOBALE USE           */
/* ---------------------------- */
use Input;
use Response;


/* ---------------------------- */
/*        LOCAL USE             */
/* ---------------------------- */
use Frenzycode\Ems\Libraries\InputHelper;
use Frenzycode\Ems\Libraries\FrenzyHelper;
use Frenzycode\Ems\Models\Field;
use Frenzycode\Ems\Models\Group;
use Frenzycode\Ems\Models\Entity;

use Frenzycode\Ems\Libraries\Upload\UploadHandler;

class EmsRestController extends \Controller{
     public function getFields() {
        $fields = Field::getFields();
        return Response::json($fields);
    }

    public function getField() {
        $fieldId = InputHelper::getInput('id', Input::all());
        $field = ($fieldId == "") ? new Field() : Field::getField($fieldId);
        $data = new \stdClass();
        $data->field = $field;
        $data->fieldTypes = $field->getFieldTypes();
        $data->valueTypes = $field->getValueTypes();
        return Response::json($data);
    }

    public function saveField() {
        $input = Input::all();
        $data = json_decode(InputHelper::getInput('data', $input));
        $action = InputHelper::getInput('action', $input);
        $field = FrenzyHelper::cast('Frenzycode\Ems\Models\Field', $data);
        if ($action == 'add') {
            $field->save();
            $data = new \stdClass();
            $data->success = new \stdClass();
            $data->success->message = "Field added successfully.";
            $data->success->url = URL::to("/fields");
            return Response::json($data);
        } else if ($action == 'update') {
            $field->update();
            $data = new \stdClass();
            $data->success = new \stdClass();
            $data->success->message = "Field updated successfully.";
            $data->success->url = URL::to("/fields");
            return Response::json($data);
        } else {
            //unknow action
            $data = new \stdClass();
            $data->error = new \stdClass();
            $data->error->message = "Unknow action.Please do again.";
            $data->success->url = URL::to("/fields");
            return Response::json($data);
        }
    }

    public function getGroups() {
        $groups = Group::getGroups();
        return Response::json($groups);
    }

    public function getGroup() {
        $id = InputHelper::getInput('id', Input::all());
        $group = ($id == "") ? new Group() : Group::getGroup($id);
        $data = new \stdClass();
        $data->group = $group;
        return Response::json($data);
    }

    public function saveGroup() {
        $input = Input::all();
        $data = json_decode(InputHelper::getInput('data', $input));
        $action = InputHelper::getInput('action', $input);
        $group = FrenzyHelper::cast('Frenzycode\Ems\Models\Group', $data);
        if ($action == 'add') {
            $group->save();
            $data = new \stdClass();
            $data->success = new \stdClass();
            $data->success->message = "Field added successfully.";
            $data->success->url = URL::to("setting/groups");
            return Response::json($data);
        } else if ($action == 'update') {
            $group->update();
            $data = new \stdClass();
            $data->success = new \stdClass();
            $data->success->message = "Field updated successfully.";
            return Response::json($data);
        } else {
            //unknow action
            $data = new \stdClass();
            $data->error = new \stdClass();
            $data->error->message = "Unknow action.Please do again.";
            return Response::json($data);
        }
    }

    public function getGroupFields() {
        $id = InputHelper::getInput('id', Input::all());
        $group = Group::getGroup($id);
        if ($group != null) {
            $data = new \stdClass();
            $group->getFields();
            $data->group = $group;
            $data->fields = Group::getFreeFields();
            return Response::json($data);
        }
        //TODO: need implement cannot find group case
        return null;
    }

    public function saveGroupFields() {
        $input = Input::all();

        $data = json_decode(InputHelper::getInput('data', $input));
        $action = InputHelper::getInput('action', $input);
        $group = FrenzyHelper::cast('Frenzycode\Ems\Models\Group', $data);

        if ($action == 'update-fields') {
            $group->saveFields();
            $data = new \stdClass();
            $data->success = new \stdClass();
            $data->success->message = "Assign fields to group successfully.";
            return Response::json($data);
        } else {
            
        }


        //TODO: need implement cannot find group case
        return null;
    }

    public function getAttributes() {
        $id = InputHelper::getInput('group', Input::all());
        $group = Group::getGroup($id);
        if ($group != null) {
            
        } else {
            //TODO: need implement cannot find group case
        }
    }

    public function getEntity() {
        $input = Input::all();
        $groupLink = InputHelper::getInput('link', $input);
        $group = Group::getGroupByLink($groupLink);
        if ($group != null) {
            $entityId = InputHelper::getInput('id', $input);
            if ($entityId == "") {
                //add new case
                $entity = new Entity();
            } else {
                $entity = Entity::getEntity($entityId);
            }
            $data = new \stdClass();
            $data->fields = Entity::getEntityFields($group->id);
            $data->entity = $entity;
            $data->entity->groupId = $group->id;
            return Response::json($data);
        } else {
            //TODO: need implement cannot find group case
        }

        $entityId = InputHelper::getInput('id', $input);

        $test = new \stdClass();
        $test->id = $entityId;
        $test->link = $groupLink;

        return Response::json($test);
    }

    public function saveEntity() {
        $input = Input::all();
        $data = json_decode(InputHelper::getInput('data', $input));
        $action = InputHelper::getInput('action', $input);
        $entity = FrenzyHelper::cast('Frenzycode\Ems\Models\Entity', $data);
        if ($action == 'add') {
            $entity->save();
            $data = new \stdClass();
            $data->success = new \stdClass();
            $data->success->message = "Entity added successfully.";
            $data->success->url = URL::to("setting/groups");
            return Response::json($data);
        } else if ($action == 'update') {
            $entity->update();
            $data = new \stdClass();
            $data->success = new \stdClass();
            $data->success->message = "Entity updated successfully.";
            return Response::json($data);
        } else {
            
        }
    }

    public function getEntities() {
        $input = Input::all();
        $groupLink = InputHelper::getInput('link', $input);
        $group = Group::getGroupByLink($groupLink);
        if ($group != null) {
            $entities = Entity::getEntities($group->id);

            $data = new \stdClass();
            $data->entities = $entities;
            $data->hasTextSearch = false;
            $data->fields = Entity::getEntitiesFieldsForSearch($group->id, $data->hasTextSearch);
            return Response::json($data);
        } else {
            //TODO: need implement cannot find group case
        }
    }

    public function searchEntities() {
        $input = Input::all();
        $groupLink = InputHelper::getInput('link', $input);
        $searchText = InputHelper::getInput('searchText', $input);
        $group = Group::getGroupByLink($groupLink);
        if ($group != null) {
            $searchFields = InputHelper::getInput('fields', $input);
            $entities = Entity::searchEntities($group->id, $searchFields, $searchText);
            return Response::json($entities);
        } else {
            //TODO: need implement cannot find group case
        }
    }
    
    public function upload()
    {
        $upload_handler = new UploadHandler();
        
        
    }
}
