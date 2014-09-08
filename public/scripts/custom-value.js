function onCustomValueAdd(element)
{
    var new_item = '<div class="row custom-value-item"><div class="col-md-5"><input type="text" class="form-control custom-value-input" data-id="-1" onkeyup="onCustomValueKeyUp(this)"></div><div class="btn-group tabletools-btn-group col-md-5"><a class="btn blue" onclick="onCustomValueAdd(this)"><i class="fa fa-plus"></i></a><a class="btn blue" onclick="onCustomValueRemove(this)"><i class="fa fa-minus"></i></a><a class="btn blue" onclick="onCustomValueUp(this)"><i class="fa fa-arrow-up"></i></a><a class="btn blue" onclick="onCustomValueUp(this)"><i class="fa fa-arrow-down"></i></a></div></div>';
    $(element).closest("div.custom-value-item").after(new_item);
}

function onCustomValueRemove(element)
{
    var group = $(element).closest("div.custom-value-group");


    if ($(group).find('div.custom-value-item').length > 1)
    {
        var input = $(element).closest("div.custom-value-item").find("input.custom-value-input").first();
        console.log($(input).val() + " : "+ $(input).data("id"));
        if (($(input).val() === null ||$(input).val() === "") && $(input).data("id") === "-1")
        {
            $(element).closest("div.custom-value-item").remove();
        }
        else
        {
            $(element).closest("div.custom-value-item").remove();
//            if (confirm("Are you sure you want to delete? All objects which have this item will be deleted too.")) {
//                
//            }
        }
    }
}

function onCustomValueUp(element)
{
    var currentItem = $(element).closest("div.custom-value-item");
    var prevItem = $(currentItem).prev();
    if (prevItem !== null)
    {
        $(prevItem).before($(currentItem));
    }
}

function onCustomValueDown(element)
{
    var currentItem = $(element).closest("div.custom-value-item");
    var nextItem = $(currentItem).next();
    if (nextItem !== null)
    {
        $(currentItem).before($(nextItem));
    }
}
;

function onCustomValueKeyUp(element)
{
    var group = $(element).closest("div.custom-value-group");
    var inputs = $(group).find("input.custom-value-input");
    var jsonObj = [];
    $(inputs).each(function() {
        var value = $(this).val();
        if (value !== "")
        {
            var item = {};
            item['id'] = $(this).data("id");
            item['value'] = value;
            jsonObj.push(item);
            ;
        }
    });
    var jsonString = JSON.stringify(jsonObj);
    $(element).closest("div.custom-value-group").find('input[type="hidden"]').first().val(jsonString);

}

function stopRKey(evt) {
    var evt = (evt) ? evt : ((event) ? event : null);
    var node = (evt.target) ? evt.target : ((evt.srcElement) ? evt.srcElement : null);
    if ((evt.keyCode === 13) && (node.type === "text")) {
        return false;
    }
}

document.onkeypress = stopRKey; 