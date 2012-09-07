    function hide_edit() {
        if (document.getElementById) 
        {
            document.getElementById('edit_block').style.display='none';
            document.getElementById('mask').style.display='none'; 
            document.getElementById('Edit_comment').innerHTML = "";
            document.getElementById('id').value = "";
        } 
    }

    function show_edit(id) {
        if (document.getElementById) 
        {
            document.getElementById('Edit_comment').innerHTML = document.getElementById('comm_'+id).innerHTML.replace(/(^[\s]+|[\s]+$)/g, '');
            document.getElementById('edit_block').style.display='block';
            document.getElementById('mask').style.display='block';
            document.getElementById('id').value = id;
        } 
    }