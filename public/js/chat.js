var REGEX_EMAIL = '([a-z0-9!#$%&\'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&\'*+/=?^_`{|}~-]+)*@' +
    '(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?)';
var loader = '<div class="loader"><div class="timer"></div></div>';
var startChat = '<div class="chat-no-messages">Choose conversation on the left to <b>start chat</b> with your friends!</div> <div class="chat-image"></div>';

$(document).ready(function () {


    $('body').tooltip({
        selector: '[data-toggle=tooltip]'
    });

    getConversations('');

    setInterval(function () {
        var conversationId = null;
        var lastPoll;

        if ($('#chat-window').find('#chatMessages').length > 0) {
            conversationId = $('#chatMessages').data('conversation');
            lastPoll = $('#conversations').find('.card[data-conversation="' + conversationId + '"]').attr('data-message-last-poll');
            pollNewMessagesOfConversation(conversationId, lastPoll);
        }
    }, 5000);

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
        var conversationUsers = $(this).data('conversation-users');

        $(this).find('.corner-ribbon').removeClass('red');
        $(this).find('.corner-ribbon').addClass('green');
        getMessages(conversationId, conversationUsers);
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
        var warningText = 'Are you sure you want to delete this message?';

        if($('#chatMessages').find('li').length === 1) {
            warningText = 'Are you sure you want to delete this message? <div class="alert alert-danger">This is the last message in this conversation, if you delete it, whole conversation will be deleted!</div>'
        }
        $.confirm({
            title: 'Delete Message',
            content: warningText,
            buttons: {
                cancel: function () {
                },
                confirm: function () {
                    deleteMessage(message);
                }
            }
        });
    });

    $('#conversations').on('click', '.card-user', function () {
        var userId = $(this).data('user');
        var userName = $(this).find('.card-title').text();
        getConversationWithUser(userId, userName);
    });

    $('#chat-window').on('click', '#addUser', function () {
        var conversationId = $('#chatMessages').data('conversation');
        getUsersThatAreNotInConversation(conversationId);
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

    $.get("/api/conversation/getAll/" + AuthUser.id, {searchQuery: searchQuery}, function (conversations) {
        conversations = JSON.parse(conversations);

        var conversationHTML = '';

        $('.conversations-list').html('<div class="friendsTitle">Conversations</div>');

        if (conversations.data.length < 1) {
            conversationHTML = '<p class="no-data">No conversations found.</p>';
        } else {
            conversations.data.forEach(function (conversation) {
                conversationHTML += '<div class="card card-conversation" data-conversation="' + conversation.id + '" data-message-last-poll="' + conversation.messages.data["0"].id + '" data-conversation-users=\'' + JSON.stringify(conversation.users) + '\'>';
                conversationHTML += '<div class="chat-images">';
                if (conversation.hasUnreadMessages) {
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

        if (users.data.length < 1) {
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

function getMessages(conversationId, conversationUsers) {
    $('#chat-window').html(loader);

    $.get("/api/message/getAll/" + conversationId, {user: AuthUser.id}, function (messages) {
        messages = JSON.parse(messages);

        var messagesHTML = '';

        if (messages.data.length < 1) {
            messagesHTML = '<p class="no-data">No messages with this friend. Say hello to him/her.</p>';
        } else {
            messagesHTML = generateMessagesHTML(messages, conversationId, conversationUsers);
        }

        lastMessagePoll = messages.data[messages.data.length - 1].id;
        $('#conversations').find('.card[data-conversation="' + conversationId + '"]').attr('data-message-last-poll', lastMessagePoll);

        $('#chat-window').html(messagesHTML);
        $('#chatMessages').animate({scrollTop: $('#chatMessages').prop("scrollHeight")}, 500);
    });
}

function postUserMessage(message, conversationId, userId) {
    var toUserId = null;

    if($('#chat-window').find('.chat-no-messages').length > 0) {
        toUserId = $('.chat-no-messages').attr('data-to-user');
    }

    var data = {
        message: message,
        conversation_id: conversationId,
        user_id: userId,
        to_user: toUserId
    };

    $.post("/api/message", data)
        .done(function (messages) {
            messages = JSON.parse(messages);

            if (messages.data.length > 0) {

                var messageTime = moment(messages.data["0"].created_at.date).format('h:mm A');
                var messageHTML = '';

                if (toUserId !== null) {
                    $('#chat-window').html(loader);

                    messageHTML = generateMessagesHTML(messages, messages.data["0"].conversation.id, {"data": messages.data["0"].conversation.users});

                    sendMessageSound();
                    $('#chat-window').html(messageHTML);
                    $('#chatMessages').animate({scrollTop: $('#chatMessages').prop("scrollHeight")}, 500);

                    getConversations('');
                } else {
                    messageHTML += '<li class="mine" data-message="' + messages.data["0"].id + '">';
                    messageHTML += '<div class="msg" data-toggle="tooltip" data-placement="left" title="' + messageTime + '">' +
                        '<p>' + messages.data["0"].text + '</p>' +
                        '<div class="hover"><a id="deleteMessage"><i class="fa fa-trash-o" aria-hidden="true"></i></a></div>' +
                        '</div>' +
                        '</li>';

                    sendMessageSound();
                    $('#chatMessages').append(messageHTML);
                    $('#chatMessages').animate({scrollTop: $('#chatMessages').prop("scrollHeight")}, 500);
                }
            }

            $('#messageToSend').val('');
            $('#sendMessage').attr('disabled', false);
        });

}

$.fn.scrollDown = function () {
    var el = $(this);
    el.scrollTop(el[0].scrollHeight);
};

function deleteMessage(messageId) {

    if($('#chatMessages').find('li').length < 1) {

    }
    $.ajax({
        method: 'DELETE',
        url: '/api/message/delete/' + messageId
    }).done(function (response) {
        if (response.success) {
            $('#chatMessages').find('li[data-message="' + messageId + '"]').hide(500, function () {
               $(this).remove();
               if($('#chatMessages').find('li').length < 1) {
                   var deletedConversation = $('#chatMessages').data('conversation');
                   $('#chat-window').html(startChat);

                   $('#conversations').find('.card[data-conversation="' + deletedConversation + '"]').hide(500, function () {
                       $(this).remove();
                   });
               }
            });
        }
    });
}

function sendMessageSound() {
    if($('#enableSound').is(":checked")) {
        $.playSound('../sounds/chat/send-message.ogg');
    }
}

function pollNewMessagesOfConversation(conversationId, lastPoll) {
    if (conversationId !== null) {
        $.get("/api/message/getNew/" + conversationId, {user: AuthUser.id, last_poll: lastPoll}, function (messages) {
            messages = JSON.parse(messages);

            var messagesHTML = '';

            if (messages.data.length > 0) {
                var lastUserId;
                var lastMessageTime = 0;
                messages.data.forEach(function (message) {
                    var messageDate = new Date(message.created_at.date).toDateString();

                    if (message.user.data.id !== AuthUser.id) {

                        messagesHTML += '<li class="other" data-message="' + message.id + '">';

                        if (message.user.data.id !== lastUserId) {
                            messagesHTML += '<div class="avatar" data-toggle="tooltip" data-placement="bottom" title="' + message.user.data.name + '">' +
                                '<img src="' + '/images/chat/default_user.jpg' + '" draggable="false">' +
                                '</div>';
                        } else {
                            messagesHTML += '<div class="avatar"></div>';
                        }
                        messagesHTML += '<div class="msg" data-toggle="tooltip" data-placement="right" title="' + message.time + '">' +
                            '<p>' + message.text + '</p>' +
                            '<div class="hover"><a id="deleteMessage"><i class="fa fa-trash-o" aria-hidden="true"></i></a></div>' +
                            '</div>';
                        messagesHTML += '</li>';
                        lastUserId = message.user.data.id;
                        lastMessageTime = messageDate;
                    }
                });

                var lastMessagePoll = messages.data[messages.data.length - 1].id;
                $('#conversations').find('.card[data-conversation="' + conversationId + '"]').attr('data-message-last-poll', lastMessagePoll);

                sendMessageSound();
                $('#chatMessages').append(messagesHTML);
                $('#chatMessages').animate({scrollTop: $('#chatMessages').prop("scrollHeight")}, 500);
            }
        });
    }

}

function getConversationWithUser(userId, userName) {
    $('#chat-window').html(loader);

    $.get("/api/conversation/getWith/" + userId, {authUser: AuthUser.id}, function (conversation) {
        conversation = JSON.parse(conversation);

        var conversationHTML = '';

        if (conversation.data.length < 1) {
            conversationHTML = '<div class="chat-no-messages" data-to-user="' + userId + '">Say hello to <b>' + userName + '</b>!</div><div class="chat-image-hello"></div>';
            conversationHTML += '<div class="add-button line-top"><div id="sendMessageDiv" class="input-group"><input id="messageToSend" type="text" placeholder="Type message.." class="form-control"> <span class="input-group-btn"><button id="sendMessage" type="button" class="btn btn-default"><i class="fa fa-paper-plane-o" aria-hidden="true"></i></button></span></div></div>';
        } else {
            conversationHTML = generateMessagesHTML(conversation.data["0"].messages, conversation.data["0"].id, conversation.data["0"].users);
        }


        $('#chat-window').html(conversationHTML);
        $('#chatMessages').animate({scrollTop: $('#chatMessages').prop("scrollHeight")}, 500);
    });
}

function generateMessagesHTML(messages, conversationId, conversationUsers){
    var messagesHTML = '';

    messagesHTML += '<div id="conversationData">';
    messagesHTML += '<div class="users">';

    var filteredUsers = {};

    filteredUsers.data = conversationUsers.data.filter(function(user) {
        return user.id !== AuthUser.id;
    });

    filteredUsers.data.forEach(function (user) {
        messagesHTML += '<span class="label label-primary badge-pill user-badge">' +
            '<img class="card-img-top" src="/images/chat/default_user.jpg" alt="' + user.name + '">' +
            '<span class="user-name">' + user.name + '</span>' +
            '</span>';
    });

    messagesHTML += '</div>';
    messagesHTML += '<div class="addUsers"><button id="deleteUser" type="button" class="btn btn-default"><i class="fa fa-minus" aria-hidden="true"></i></button><button id="addUser" type="button" class="btn btn-default"><i class="fa fa-plus" aria-hidden="true"></i></button></div>';
    messagesHTML += '</div>';

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

        if (whoseMessage === 'other' && message.user.data.id !== lastUserId) {
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
    messagesHTML += '<div class="add-button line-top"><div id="sendMessageDiv" class="input-group"><input id="messageToSend" type="text" placeholder="Type message.." class="form-control"> <span class="input-group-btn"><button id="sendMessage" type="button" class="btn btn-default"><i class="fa fa-paper-plane-o" aria-hidden="true"></i></button></span></div></div>';

    return messagesHTML;
}

function getUsersThatAreNotInConversation(conversationId) {

    $.get('/api/user/getNotInConversation/' + conversationId, function (users) {
        var content = '<select id="selectedUsers" data-placeholder="Select users..." multiple name="selectedUsers[]" class="chosen-select">';

        users = JSON.parse(users);

        users.data.forEach(function (user) {
            content += '<option value="' + user.id + '">' + user.name + '</option>';
        });

        content += '</select>';

        $.confirm({
            title: 'Add users',
            content: '' + content,
            buttons: {
                formSubmit: {
                    text: 'Submit',
                    btnClass: 'btn-blue',
                    action: function () {
                        var users = this.$content.find('#selectedUsers').val();
                        addUsersToConversation(conversationId, users);
                    }
                },
                cancel: function () {
                },
            },
            onContentReady: function () {
                // bind to events
                $(".chosen-select").chosen({no_results_text: "Oops, nothing found!", width: "100%"});
                var jc = this;
                this.$content.find('form').on('submit', function (e) {
                    // if the user submits the form by pressing enter in the field.
                    e.preventDefault();
                    jc.$$formSubmit.trigger('click'); // reference the button and click it
                });
            }
        });
    });
}

function addUsersToConversation(conversationId, users) {

    var data = {
        conversation_id: conversationId,
        users: users
    };

    $.post("/api/conversation/addUsers", data)
        .done(function (conversation) {
            conversation = JSON.parse(conversation);

            if (conversation.data.length > 0) {
                $('#conversationData').find('.users').find('span').hide(500);
                var filteredUsers = {};

                filteredUsers.data = conversation.data["0"].users.data.filter(function(user) {
                    return user.id !== AuthUser.id;
                });

                filteredUsers.data.forEach(function (user) {
                    var userHTML = '<span class="label label-primary badge-pill user-badge">' +
                        '<img class="card-img-top" src="/images/chat/default_user.jpg" alt="' + user.name + '">' +
                        '<span class="user-name">' + user.name + '</span>' +
                        '</span>';

                    $(userHTML).hide().appendTo("#conversationData .users").delay(500).show(1000);
                });

                $('#conversations').find('.card[data-conversation="' + conversationId + '"]').data('conversation-users', filteredUsers);

                getConversations('');

            }
        });
}