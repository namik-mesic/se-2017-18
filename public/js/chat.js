var REGEX_EMAIL = '([a-z0-9!#$%&\'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&\'*+/=?^_`{|}~-]+)*@' +
    '(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?)';
var loader = '<div class="loader"><div class="timer"></div></div>';

$(document).ready(function () {

    $('body').tooltip({
        selector: '[data-toggle=tooltip]'
    });

    getConversations('');

    $('#getConversations').on('click', function () {
        changeSearch('conversations');
        getConversations('');
        resetSearch();
    });

    $('#getFriends').on('click', function () {
        changeSearch('friends');
        getFriends('');
        resetSearch();
    });

    $('[data-toggle="tooltip"]').tooltip();

    $('#hideSidebar').on('click', function () {
       hideSidebar();
    });

    $('#showSidebar').on('click', function () {
        showSidebar();
    });

    $('#searchConversations').on('click', function () {
        var searchQuery = $('#searchConversationQuery').val().toString().trim();
       getConversations(searchQuery);
    });

    $('#searchFriends').on('click', function () {
        var searchQuery = $('#searchFriendsQuery').val().toString().trim();
        getFriends(searchQuery);
    });

    $('#conversations').on('click', '.card-conversation', function () {
        var conversationId = $(this).data('conversation');
        $(this).find('.corner-ribbon').removeClass('red');
        $(this).find('.corner-ribbon').addClass('green');
        getMessages(conversationId);
    });

    $('#chat-window').on('click', '#sendMessage', function () {
        var message = $('#messageToSend').val().toString().trim();
        var conversation = $('#chatMessages').data('conversation');

        $(this).attr('disabled', true);

        if (message.length > 0) {
           postUserMessage(message, conversation, AuthUser.id);
        } else {
            $(this).attr('disabled', false);
        }
    });

    $('#chat-window').on('click', '#deleteMessage', function () {
        var message = $(this).closest('li').data('message');
        $.confirm({
            title: 'Delete Message',
            content: 'Are you sure you want to delete this message?',
            buttons: {
                cancel: function () {},
                confirm: function () {
                    deleteMessage(message);
                },
            }
        });
    });
});

function hideSidebar() {
    var sidebar = $('#chat #my-panel');
    sidebar.addClass('hideSidebar');

    $('#sidebarButton').show();
}

function showSidebar() {
    var sidebar = $('#chat #my-panel');
    sidebar.removeClass('hideSidebar');

    $('#sidebarButton').hide();
}

function getConversations(searchQuery) {
    $('.conversations-list').html(loader);

    $.get("/api/conversation/getAll/" + AuthUser.id, {searchQuery: searchQuery} ,function (conversations) {
        conversations = JSON.parse(conversations);

        var conversationHTML = '';

        $('.conversations-list').html('<div class="friendsTitle">Conversations</div>');

        if(conversations.data.length < 1) {
            conversationHTML = '<p class="no-data">No conversations found.</p>';
        } else {
            conversations.data.forEach(function (conversation) {
                conversationHTML += '<div class="card card-conversation" data-conversation="' + conversation.id + '">';
                conversationHTML += '<div class="chat-images">';
                if(conversation.hasUnreadMessages) {
                    conversationHTML += '<div class="corner-ribbon top-right sticky red"></div>';
                }
                conversation.users.data.forEach(function (user, index) {
                    if (index === 0) {
                        conversationHTML += '<div class="chat-image big">' +
                                            '<img class="card-img-top" src="' + '/images/chat/default_user.jpg' + '" alt="' + user.name + '">' +
                                            '</div>';
                    } else if (index === 1 || index === 2) {
                        conversationHTML += '<div class="chat-image small">' +
                                            '<img class="card-img-top" src="' + '/images/chat/default_user.jpg' + '" alt="' + user.name + '">' +
                                            '</div>';
                    }
                });
                conversationHTML += '</div>';
                conversationHTML += '<div class="card-body">' +
                                    '<h4 class="card-title">';
                conversation.users.data.forEach(function (user) {
                    conversationHTML += '<span class="label label-primary badge-pill">' + user.name + '</span>'
                });
                conversationHTML += '</h4>';
                conversationHTML += '<p class="card-text"><b>' + conversation.messages.data["0"].user.data.name + '</b>: ' + conversation.messages.data["0"].text + '</p>';
                conversationHTML += '</div>';
                conversationHTML += '</div>';
            });

        }

        $('.conversations-list').append(conversationHTML);

    });
}

function getFriends(searchQuery) {
    $('.conversations-list').html(loader);

    $.get("/api/user/getAll/" + AuthUser.id, {searchQuery: searchQuery}, function (users) {
        users = JSON.parse(users);

        var usersHTML = '';

        $('.conversations-list').html('<div class="friendsTitle">Friends</div>');

        if(users.data.length < 1) {
            usersHTML = '<p class="no-data">No friends found.</p>';
        } else {
            users.data.forEach(function (user) {
                usersHTML += '<div class="card card-user" data-user="' + user.id + '">';
                usersHTML += '<div class="chat-images">';
                usersHTML += '<div class="chat-image big">' +
                            '<img class="card-img-top" src="' + '/images/chat/default_user.jpg' + '" alt="' + user.name + '">' +
                            '</div>';
                usersHTML += '</div>';
                usersHTML += '<div class="card-body">' +
                            '<h4 class="card-title">' + user.name + '</h4>';
                usersHTML += '<p class="card-text">' + user.email + '</p>';
                usersHTML += '</div>';
                usersHTML += '</div>';
            });
        }

        $('.conversations-list').append(usersHTML);
    });
}

function changeSearch(type) {
    $('.search-conversation').find('.input-group').hide();
    if (type === 'conversations') {
        $('#searchConversationsDIV').css('display', 'table');
    } else if (type === 'friends') {
        $('#searchFriendsDIV').css('display', 'table');
    }
}

function resetSearch() {
    $('.search-conversation').find('input').val('');
}

function getMessages(conversationId) {
    $('#chat-window').html(loader);

    $.get("/api/message/getAll/" + conversationId, {user: AuthUser.id}, function (messages) {
        messages = JSON.parse(messages);

        var messagesHTML = '';

        if (messages.data.length < 1) {
            messagesHTML = '<p class="no-data">No messages with this friend. Say hello to him/her.</p>';
        } else {
            messagesHTML += '<ul id="chatMessages" data-conversation="' + conversationId + '">';
            var lastUserId;
            var lastMessageTime = 0;
            messages.data.forEach(function (message) {
                var messageDate = new Date(message.created_at.date).toDateString();
                var whoseMessage = '';
                var tooltipWhere = '';

                if (message.user.data.id !== AuthUser.id) {
                    whoseMessage = 'other';
                    tooltipWhere = 'right';
                } else {
                    whoseMessage = 'mine';
                    tooltipWhere = 'left';
                }

                if (new Date(messageDate).getTime() !== new Date(lastMessageTime).getTime()) {
                    messagesHTML += '<div class="day"><p>' + messageDate + '</p></div>';
                }

                messagesHTML += '<li class="' + whoseMessage + '" data-message="' + message.id + '">';

                if(whoseMessage === 'other' && message.user.data.id !== lastUserId) {
                    messagesHTML += '<div class="avatar" data-toggle="tooltip" data-placement="bottom" title="' + message.user.data.name + '">' +
                        '<img src="' + '/images/chat/default_user.jpg' + '" draggable="false">' +
                        '</div>';
                } else if (whoseMessage === 'other') {
                    messagesHTML += '<div class="avatar"></div>';
                }
                messagesHTML += '<div class="msg" data-toggle="tooltip" data-placement="' + tooltipWhere + '" title="' + message.time + '">' +
                                '<p>' + message.text + '</p>' +
                                '<div class="hover"><a id="deleteMessage"><i class="fa fa-trash-o" aria-hidden="true"></i></a></div>' +
                                '</div>';
                messagesHTML += '</li>';
                lastUserId = message.user.data.id;
                lastMessageTime = messageDate;
            });

            messagesHTML += '</ul>';
        }

        messagesHTML += '<div class="add-button line-top"><div id="sendMessageDiv" class="input-group"><input id="messageToSend" type="text" placeholder="Type message.." class="form-control"> <span class="input-group-btn"><button id="sendMessage" type="button" class="btn btn-default"><i class="fa fa-paper-plane-o" aria-hidden="true"></i></button></span></div></div>';

        $('#chat-window').html(messagesHTML);
        $('#chatMessages').animate({scrollTop: $('#chatMessages').prop("scrollHeight")}, 500);
    });
}

function postUserMessage(message, conversationId, userId) {
    var data = {
        message: message,
        conversation_id: conversationId,
        user_id: userId
    };

    $.post("/api/message", data)
        .done( function(response) {
            if (response.success) {
                var messageTime = moment().format('h:mm A');
                var messageHTML = '';

                messageHTML += '<li class="mine" data-message="' + response.message_id + '">';
                messageHTML += '<div class="msg" data-toggle="tooltip" data-placement="left" title="' + messageTime + '">' +
                    '<p>' + message + '</p>' +
                    '<div class="hover"><a id="deleteMessage"><i class="fa fa-trash-o" aria-hidden="true"></i></a></div>' +
                    '</div>' +
                    '</li>';
            }

            sendMessageSound();
            $('#chatMessages').append(messageHTML);
            $('#chatMessages').animate({scrollTop: $('#chatMessages').prop("scrollHeight")}, 500);

            $('#messageToSend').val('');
            $('#sendMessage').attr('disabled', false);
        });

}

$.fn.scrollDown=function(){
    var el=$(this);
    el.scrollTop(el[0].scrollHeight);
};

function deleteMessage(messageId) {
    $.ajax({
        method: 'DELETE',
        url: '/api/message/delete/' + messageId
    }).done( function(response) {
        if (response.success) {
            $('#chatMessages').find('li[data-message="' + messageId + '"]').hide(500);
        }
    });
}

function sendMessageSound(){
    $.playSound('../sounds/chat/send-message.ogg');
}