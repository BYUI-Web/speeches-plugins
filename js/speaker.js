//It uses jQuery and a plugin called token input.  Token Input uses two files, one css, and one js file.


//this is the array that you have to populate with all of the ids and names of the speaker posts
//that have been created

// var speakers = [
//     {
//         "id": 1,
//         "name": "President Clark - 2014"
//     },
//     {
//         "id": 2,
//         "name": "President Clark - 2013"
//     },
//     {
//         "id": 3,
//         "name": "Elder Oaks - 2014"
//     },
//     {
//         "id": 4,
//         "name": "Elder Oaks - 2010"
//     },
//     {
//         "id": 5,
//         "name": "Brother Galer"
//     },
//     {
//         "id": 6,
//         "name": "Matthew Sessions"
//     },
//     {
//         "id": 7,
//         "name": "Josh Crowther"
//     }
// ];

//This is an array for prepopulating the input
//you will have to prepopulate the hidden id's input with the ids as well.  They are comma delimited with
//a space between the command and the next id

// var prepopulate = [
//     {
//         "id": 1,
//         "name": "President Clark - 2014"
//     },
//     {
//         "id": 4,
//         "name": "Elder Oaks - 2010"
//     },
//     {
//         "id": 7,
//         "name": "Josh Crowther"
//     }
// ];

//Below is all the code to make it work
jQuery('#speaker-names').tokenInput(speakers, {
    onAdd: addId,
    onDelete: removeId,
    preventDuplicates: true,
    prePopulate: prepopulate
});

function addId(object) {
    var $ele = jQuery('#speaker-ids');
    var val = $ele.val();
    if (val == "") {
        $ele.val(object.id);
    } else {
        $ele.val(val + ", " + object.id);
    }
}

function removeId(object) {
    var $ele = jQuery('#speaker-ids');
    var ids = $ele.val();
    var regexp = new RegExp(object.id + "{1},\\W|,\\W" + object.id + "{1}$|^" + object.id + "$");
    $ele.val(ids.replace(regexp, ""));
}