bootChat();

$(document).on('click', '[data-toggle="popover"]', function()
{
        $(this).popover('hide');
        $('ul.chat-box-body').empty();
        user = $(this).find('input[name="user_id"]').val();
        $(this).find('span[rel="'+user+'"]').text('');
        load_thread(user);
        var offset = $(this).offset(); 
        var h_main = $('#chat-container').height();
        var h_title = $("#chat-box > .chat-box-header").height();
        var top = ($('#chat-box').is(':visible') ? (offset.top - h_title - 40) : (offset.top + h_title - 20));
        if((top + $('#chat-box').height()) > h_main){ top = h_main -  $('#chat-box').height();}
        $('#chat-box').css({'top': top});
        if(!$('#chat-box').is(':visible')){
            $('#chat-box').toggle('slide',{
                direction: 'right'
            }, 500);
        }
        $('.chat-box-body').slimScroll({ height: '300px' });
        $("#chat-box .chat-textarea input").focus();
});

$(document).on('keypress', '.chat-textarea input', function(e){
        var txtarea = $(this);
        var message = txtarea.val();
        if(message !== "" && e.which == 13){
            txtarea.val('');
            $.ajax({ type: "POST", url: base  + "chat/save_message", data: {message: message, user : user},cache: false,
                success: function(response){
                    msg = response.message;
                    li = '<li class=" bubble '+ msg.type +'"><img src="assets/assets/images/thumbs/'+msg.avatar+'" class="avt img-responsive">\
                    <div class="message">\
                    <span class="chat-arrow"></span>\
                    <a href="javascript:void(0)" class="chat-name">'+msg.name+'</a>&nbsp;\
                    <span class="chat-datetime">at '+msg.time+'</span>\
                    <span class="chat-body">'+msg.body+'</span></div></li>';
                    $('ul.chat-box-body').append(li);
                    $('ul.chat-box-body').animate({scrollTop: $('ul.chat-box-body').prop("scrollHeight")}, 500);
                }
            });
        }
});

function bootChat()
{
    refresh = setInterval(function()
    {
        $.ajax(
        {
            type: 'GET',
            url : base + "chat/updates/",
            async : true,
            cache : false,
            success: function(data){
                if(data.success){
                     thread = data.messages;
                     senders = data.senders;
                     $.each(thread, function() {
                        if($("#chat-box").is(":visible")){
                            chatbuddy = $("#chat_buddy_id").val();
                                if(this.sender == chatbuddy){
                                  li = '<li class="'+ this.type +'"><img src="assets/assets/images/thumbs/'+this.avatar+'" class="avt img-responsive">\
                                    <div class="message">\
                                    <span class="chat-arrow"></span>\
                                    <a href="javascript:void(0)" class="chat-name">'+this.name+'</a>&nbsp;\
                                    <span class="chat-datetime">at '+this.time+'</span>\
                                    <span class="chat-body">'+this.body+'</span></div></li>';
                                    $('ul.chat-box-body').append(li);
                                    $('ul.chat-box-body').animate({scrollTop: $('ul.chat-box-body').prop("scrollHeight")}, 500);                                    
                                $.ajax({ type: "POST", url: base + "chat/mark_read", data: {id: this.msg}});
                                }
                                else{
                                    from = this.sender;
                                    $.each(senders, function() {
                                        if(this.user == from){
                                            $(".chat-group").find('span[rel="'+from+'"]').text(this.count);
                                        }
                                    });
                                }
                         }
                         else{
                            from = this.sender;
                            $.each(senders, function() {
                                if(this.user == from){
                                    $(".chat-group").find('span[rel="'+from+'"]').text(this.count);
                                }
                            });
                            
                         }
                     });

                    var audio = new Audio('assets/assets/notify/notify.mp3').play();
                }
            },
                error : function(XMLHttpRequest, textstatus, error) { 
                            console.log(error); 
                }
            }
        );
    }, 2000);
}
var limit = 1;
function load_thread(user, limit)
{
       $.ajax({ type: "POST", url: base  + "chat/messages", data: {user : user, limit:limit },cache: false,
        success: function(response){
        if(response.success){
            buddy = response.buddy;
            status = buddy.status == 1 ? 'Online' : 'Offline';
            statusClass = buddy.status == 1 ? 'user-status is-online' : 'user-status is-offline';

            $('#chat_buddy_id').val(buddy.id);
            $('.display-name', '#chat-box').html(buddy.name);
            $('#chat-box > .chat-box-header > small').html(status);
            $('#chat-box > .chat-box-header > span.user-status').removeClass().addClass(statusClass);

            $('ul.chat-box-body').html('');
            if(buddy.more){
             $('ul.chat-box-body').append('<li id="load-more-wrap" style="text-align:center"><a onclick="javascript: load_thread(\''+buddy.id+'\', \''+buddy.limit+'\')" class="btn btn-xs btn-info" style="width:100%">View older messsages('+buddy.remaining+')</a></li>');
            }
            thread = response.thread;
            $.each(thread, function() 
            {
                li = '<li class="'+ this.type +'"><img src="assets/assets/images/thumbs/'+this.avatar+'" class="avt img-responsive">\
                    <div class="message">\
                    <span class="chat-arrow"></span>\
                    <a href="javascript:void(0)" class="chat-name">'+this.name+'</a>&nbsp;\
                    <span class="chat-datetime">at '+this.time+'</span>\
                    <span class="chat-body">'+this.body+'</span></div></li>';
                    $('ul.chat-box-body').append(li);
                });
                if(buddy.scroll){
                    $('ul.chat-box-body').animate({scrollTop: $('ul.chat-box-body').prop("scrollHeight")}, 500);
                }
            }
        }});
}