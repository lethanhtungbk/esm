<div ems-entity-form 
     action = "{{$templateData->action}}"
     id ="{{$templateData->id}}"
     link="{{$templateData->groupLink}}"
     successurl="{{URL::to('entities/'.$templateData->groupLink)}}" 
     cancelurl="{{URL::to('entities/'.$templateData->groupLink)}}" 
/>         