var REGEX_EMAIL = '([a-z0-9!#$%&\'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&\'*+/=?^_`{|}~-]+)*@' +
    '(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?)';
var loader = '<div class="loader"><div class="timer"></div></div>';

$(document).ready(function () {

    getConversation('');

    $('#getConversations').on('click', function () {
        changeSearch('conversations');
        getConversation('');
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
       getConversation(searchQuery);
    });

    $('#searchFriends').on('click', function () {
        var searchQuery = $('#searchFriendsQuery').val().toString().trim();
        getFriends(searchQuery);
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

function getConversation(searchQuery) {
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
                if(conversation.messages.data.length > 0) {
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