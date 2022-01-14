
function confirmDeleteRoom() {

    return confirm("Do you want to delete this room ? ");
}
function confirmDeleteStudent() {

    return confirm("Do you want to delete this post ? ");
}
function confirmDeleteTags() {

    return confirm("Do you want to delete this tag ? ");
}
function confirmDeleteCategory() {

    return confirm("Do you want to delete this catagory ? ");
}

$("#close").click(function() {
            $(".message_background").fadeOut("slow");
});
