    var $j = jQuery.noConflict();
    function show_edit(id) {
        if (document.getElementById) 
        {
            document.getElementById('edit_comment').innerHTML = document.getElementById('comm_'+id).innerHTML.replace(/(^[\s]+|[\s]+$)/g, '');
            document.getElementById('edit_block').style.display='block';
            document.getElementById('mask').style.display='block';
            document.getElementById('id').value = id;
        } 
    }

    function hide_edit() {
        if (document.getElementById) 
        {
            document.getElementById('edit_block').style.display='none';
            document.getElementById('mask').style.display='none'; 
            document.getElementById('edit_comment').innerHTML = "";
            document.getElementById('id').value = "";
        } 
    }    

    function delete_link(id) {

        var l = window.location;
        var base_url = l.protocol + "//" + l.host + "/" + l.pathname.split('/')[1];
        $j.ajax({    
            url: base_url + "/comments/adminhtml_comments/delete/id/"+id+"/key/"+$j('#delete_key').val(),
            success: function(html) {
                document.getElementById('comment'+id).style.display='none';
            }
        });        
    } 


    $j(document).ready(function() {        

        $j('#send_submit').click(function (e) {
            e.preventDefault();

        var data = $("post_form").serialize();
        var form_post = "<div id='comment"+parseInt($j('#last_id').val())+"'><table id='comment_list'><tr><td collspan='2 '><b>"+$j('#Author').val()+"</b></td></tr><tr><td collspan='2'><div id='comm_"+parseInt($j('#last_id').val())+"'>"+$j('#Comment').val()+"</div></td></tr><tr><td>"+$j('#date').val()+"</td><td><div id='edit_panel'><a href='#' onclick='show_edit("+$j('#last_id').val()+")'>Edit</a> &nbsp <a href='#' onclick='delete_link("+$j('#last_id').val()+")'>Delete</a></div></td></tr></table><br /></div>";
        $j.ajax({
                type: "POST",
                url: $j('#url').val(),
                data: data,
                success: function(html) {
                    $j(form_post).prependTo('#group_fields4');
                    $j('#Comment').val("");
                    $j('#last_id').val(parseInt($j('#last_id').val())+1)
                }
            });
        });   

    });